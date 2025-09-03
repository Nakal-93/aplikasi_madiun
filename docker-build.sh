#!/bin/bash

# 🐳 Docker Build dan Management Script untuk Aplikasi Madiun
# Usage: ./docker-build.sh [action] [environment]

set -e

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

# Functions
print_status() { echo -e "${GREEN}[INFO]${NC} $1"; }
print_warning() { echo -e "${YELLOW}[WARNING]${NC} $1"; }
print_error() { echo -e "${RED}[ERROR]${NC} $1"; }
print_step() { echo -e "${BLUE}[STEP]${NC} $1"; }

# Default values
ACTION=${1:-build}
ENVIRONMENT=${2:-production}
IMAGE_NAME="aplikasi-madiun"
REGISTRY=${DOCKER_REGISTRY:-"your-registry.com"}

print_status "🐳 Docker Build Script"
print_status "Action: $ACTION"
print_status "Environment: $ENVIRONMENT"

# Get version info
GIT_COMMIT=$(git rev-parse --short HEAD 2>/dev/null || echo "unknown")
BUILD_DATE=$(date -u +'%Y-%m-%dT%H:%M:%SZ')
VERSION=$(git describe --tags --always 2>/dev/null || echo "v1.0.0")

# Set image tags
BASE_TAG="$IMAGE_NAME:$VERSION"
ENV_TAG="$IMAGE_NAME:$ENVIRONMENT-latest"
COMMIT_TAG="$IMAGE_NAME:$ENVIRONMENT-$GIT_COMMIT"
REGISTRY_TAG="$REGISTRY/$IMAGE_NAME:$VERSION"

print_status "Version: $VERSION"
print_status "Commit: $GIT_COMMIT"
print_status "Build Date: $BUILD_DATE"

# Function to build production image
build_production() {
    print_step "Building production image..."
    
    docker build \
        --target production \
        --build-arg BUILD_DATE="$BUILD_DATE" \
        --build-arg VCS_REF="$GIT_COMMIT" \
        --build-arg VERSION="$VERSION" \
        -t $BASE_TAG \
        -t $ENV_TAG \
        -t $COMMIT_TAG \
        .
    
    print_status "Production image built successfully!"
    print_status "Tags: $BASE_TAG, $ENV_TAG, $COMMIT_TAG"
}

# Function to build development image
build_development() {
    print_step "Building development image..."
    
    docker build \
        -f Dockerfile.dev \
        --build-arg BUILD_DATE="$BUILD_DATE" \
        --build-arg VCS_REF="$GIT_COMMIT" \
        --build-arg VERSION="$VERSION" \
        -t "$IMAGE_NAME:dev-latest" \
        -t "$IMAGE_NAME:dev-$GIT_COMMIT" \
        .
    
    print_status "Development image built successfully!"
    print_status "Tags: $IMAGE_NAME:dev-latest, $IMAGE_NAME:dev-$GIT_COMMIT"
}

# Function to push images to registry
push_images() {
    print_step "Pushing images to registry..."
    
    if [ "$ENVIRONMENT" = "development" ]; then
        docker tag "$IMAGE_NAME:dev-latest" "$REGISTRY/$IMAGE_NAME:dev-latest"
        docker tag "$IMAGE_NAME:dev-$GIT_COMMIT" "$REGISTRY/$IMAGE_NAME:dev-$GIT_COMMIT"
        docker push "$REGISTRY/$IMAGE_NAME:dev-latest"
        docker push "$REGISTRY/$IMAGE_NAME:dev-$GIT_COMMIT"
    else
        docker tag $BASE_TAG $REGISTRY_TAG
        docker tag $ENV_TAG "$REGISTRY/$IMAGE_NAME:$ENVIRONMENT-latest"
        docker push $REGISTRY_TAG
        docker push "$REGISTRY/$IMAGE_NAME:$ENVIRONMENT-latest"
    fi
    
    print_status "Images pushed successfully!"
}

# Function to run production container
run_production() {
    print_step "Running production container..."
    
    # Stop and remove existing container
    docker stop aplikasi-madiun-prod 2>/dev/null || true
    docker rm aplikasi-madiun-prod 2>/dev/null || true
    
    # Run new container
    docker run -d \
        --name aplikasi-madiun-prod \
        --restart unless-stopped \
        -p 80:80 \
        -p 443:443 \
        -e APP_ENV=production \
        -e APP_DEBUG=false \
        -e APP_URL=https://apps.madiunkab.go.id \
        --network aplikasi-network \
        $ENV_TAG
    
    print_status "Production container started!"
    print_status "Access: http://localhost"
}

# Function to run development environment
run_development() {
    print_step "Starting development environment..."
    
    # Check if docker-compose is available
    if ! command -v docker-compose &> /dev/null; then
        print_error "docker-compose not found. Please install docker-compose."
        exit 1
    fi
    
    # Start development environment
    docker-compose -f docker-compose.dev.yml up -d
    
    print_status "Development environment started!"
    print_status "Application: http://localhost:8000"
    print_status "phpMyAdmin: http://localhost:8080"
    print_status "MailHog: http://localhost:8025"
    print_status "Redis Commander: http://localhost:8081"
}

# Function to run production stack
run_production_stack() {
    print_step "Starting production stack..."
    
    # Check if docker-compose is available
    if ! command -v docker-compose &> /dev/null; then
        print_error "docker-compose not found. Please install docker-compose."
        exit 1
    fi
    
    # Start production stack
    docker-compose up -d
    
    print_status "Production stack started!"
    print_status "Application: http://localhost"
    print_status "Prometheus: http://localhost:9090"
    print_status "Grafana: http://localhost:3000 (admin/admin123)"
}

# Function to stop containers
stop_containers() {
    print_step "Stopping containers..."
    
    if [ "$ENVIRONMENT" = "development" ]; then
        docker-compose -f docker-compose.dev.yml down
    else
        docker-compose down
        docker stop aplikasi-madiun-prod 2>/dev/null || true
    fi
    
    print_status "Containers stopped!"
}

# Function to clean up images
cleanup() {
    print_step "Cleaning up Docker images..."
    
    # Remove dangling images
    docker image prune -f
    
    # Remove old aplikasi-madiun images (keep last 5)
    docker images "$IMAGE_NAME" --format "table {{.ID}}\t{{.Tag}}\t{{.CreatedAt}}" | \
        tail -n +6 | awk '{print $1}' | xargs -r docker rmi 2>/dev/null || true
    
    print_status "Cleanup completed!"
}

# Function to show container status
show_status() {
    print_step "Container Status:"
    
    echo "Running containers:"
    docker ps --filter "name=aplikasi-madiun" --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"
    
    echo ""
    echo "Available images:"
    docker images "$IMAGE_NAME" --format "table {{.Repository}}\t{{.Tag}}\t{{.Size}}\t{{.CreatedAt}}"
}

# Function to view logs
view_logs() {
    print_step "Container Logs:"
    
    if [ "$ENVIRONMENT" = "development" ]; then
        docker-compose -f docker-compose.dev.yml logs -f --tail=100
    else
        docker logs -f aplikasi-madiun-prod 2>/dev/null || \
        docker-compose logs -f --tail=100
    fi
}

# Function to execute commands in container
exec_container() {
    COMMAND=${3:-bash}
    
    if [ "$ENVIRONMENT" = "development" ]; then
        docker-compose -f docker-compose.dev.yml exec app $COMMAND
    else
        docker exec -it aplikasi-madiun-prod $COMMAND
    fi
}

# Main execution
case $ACTION in
    build)
        if [ "$ENVIRONMENT" = "development" ]; then
            build_development
        else
            build_production
        fi
        ;;
    push)
        push_images
        ;;
    run)
        if [ "$ENVIRONMENT" = "development" ]; then
            run_development
        elif [ "$ENVIRONMENT" = "stack" ]; then
            run_production_stack
        else
            run_production
        fi
        ;;
    stop)
        stop_containers
        ;;
    restart)
        stop_containers
        sleep 2
        if [ "$ENVIRONMENT" = "development" ]; then
            run_development
        else
            run_production_stack
        fi
        ;;
    status)
        show_status
        ;;
    logs)
        view_logs
        ;;
    exec)
        exec_container
        ;;
    cleanup)
        cleanup
        ;;
    all)
        if [ "$ENVIRONMENT" = "development" ]; then
            build_development
            run_development
        else
            build_production
            run_production_stack
        fi
        show_status
        ;;
    *)
        print_error "Invalid action. Available actions:"
        echo "  build     - Build Docker image"
        echo "  push      - Push image to registry"
        echo "  run       - Run container/stack"
        echo "  stop      - Stop containers"
        echo "  restart   - Restart containers"
        echo "  status    - Show container status"
        echo "  logs      - View container logs"
        echo "  exec      - Execute command in container"
        echo "  cleanup   - Clean up old images"
        echo "  all       - Build and run"
        echo ""
        echo "Environments: development, production, stack"
        echo ""
        echo "Examples:"
        echo "  ./docker-build.sh build production"
        echo "  ./docker-build.sh run development"
        echo "  ./docker-build.sh all stack"
        exit 1
        ;;
esac

print_status "✅ Docker operation completed!"

# Show helpful information
if [ "$ACTION" = "run" ] || [ "$ACTION" = "all" ]; then
    echo ""
    print_status "Useful commands:"
    echo "  📋 View logs: ./docker-build.sh logs $ENVIRONMENT"
    echo "  📊 Check status: ./docker-build.sh status"
    echo "  🔧 Execute shell: ./docker-build.sh exec $ENVIRONMENT bash"
    echo "  🛑 Stop containers: ./docker-build.sh stop $ENVIRONMENT"
    echo "  🔄 Restart: ./docker-build.sh restart $ENVIRONMENT"
fi
