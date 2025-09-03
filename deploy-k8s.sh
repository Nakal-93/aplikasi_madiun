#!/bin/bash

# 🚀 Kubernetes Deployment Script untuk Aplikasi Data Aplikasi Kabupaten Madiun
# Usage: ./deploy-k8s.sh [environment] [action]
# Environment: dev, staging, production
# Action: deploy, update, rollback, destroy

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
ENVIRONMENT=${1:-production}
ACTION=${2:-deploy}
NAMESPACE="aplikasi-madiun"
IMAGE_TAG=${3:-latest}

print_status "🚀 Kubernetes Deployment Script"
print_status "Environment: $ENVIRONMENT"
print_status "Action: $ACTION"
print_status "Image Tag: $IMAGE_TAG"

# Validate environment
case $ENVIRONMENT in
    dev|staging|production)
        print_status "Valid environment: $ENVIRONMENT"
        ;;
    *)
        print_error "Invalid environment. Use: dev, staging, or production"
        exit 1
        ;;
esac

# Check kubectl
if ! command -v kubectl &> /dev/null; then
    print_error "kubectl not found. Please install kubectl."
    exit 1
fi

# Check if connected to cluster
if ! kubectl cluster-info &> /dev/null; then
    print_error "Not connected to Kubernetes cluster."
    exit 1
fi

# Update namespace based on environment
if [ "$ENVIRONMENT" != "production" ]; then
    NAMESPACE="aplikasi-madiun-$ENVIRONMENT"
fi

print_status "Using namespace: $NAMESPACE"

# Function to build and push Docker image
build_and_push_image() {
    print_step "Building Docker image..."
    
    # Get git commit hash for tagging
    GIT_COMMIT=$(git rev-parse --short HEAD 2>/dev/null || echo "unknown")
    FULL_IMAGE_TAG="${ENVIRONMENT}-${GIT_COMMIT}-${IMAGE_TAG}"
    
    print_status "Building image with tag: $FULL_IMAGE_TAG"
    
    # Build image
    docker build -t aplikasi-madiun:$FULL_IMAGE_TAG .
    
    # Tag for registry (sesuaikan dengan registry Anda)
    REGISTRY=${DOCKER_REGISTRY:-"your-registry.com"}
    docker tag aplikasi-madiun:$FULL_IMAGE_TAG $REGISTRY/aplikasi-madiun:$FULL_IMAGE_TAG
    docker tag aplikasi-madiun:$FULL_IMAGE_TAG $REGISTRY/aplikasi-madiun:$ENVIRONMENT-latest
    
    # Push to registry
    print_step "Pushing image to registry..."
    docker push $REGISTRY/aplikasi-madiun:$FULL_IMAGE_TAG
    docker push $REGISTRY/aplikasi-madiun:$ENVIRONMENT-latest
    
    # Update image tag in deployments
    export IMAGE_TAG=$FULL_IMAGE_TAG
    export REGISTRY_IMAGE="$REGISTRY/aplikasi-madiun:$FULL_IMAGE_TAG"
}

# Function to create namespace
create_namespace() {
    print_step "Creating namespace: $NAMESPACE"
    
    kubectl create namespace $NAMESPACE --dry-run=client -o yaml | kubectl apply -f -
    
    # Label namespace
    kubectl label namespace $NAMESPACE environment=$ENVIRONMENT --overwrite
}

# Function to generate secrets
generate_secrets() {
    print_step "Generating secrets..."
    
    # Generate random passwords if not provided
    DB_PASSWORD=${DB_PASSWORD:-$(openssl rand -base64 32)}
    MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD:-$(openssl rand -base64 32)}
    APP_KEY=${APP_KEY:-$(openssl rand -base64 32)}
    
    # Create secrets
    kubectl create secret generic app-secrets \
        --namespace=$NAMESPACE \
        --from-literal=DB_DATABASE=$(echo -n "aplikasi_madiun_$ENVIRONMENT" | base64 -w 0) \
        --from-literal=DB_USERNAME=$(echo -n "madiun_user_$ENVIRONMENT" | base64 -w 0) \
        --from-literal=DB_PASSWORD=$(echo -n "$DB_PASSWORD" | base64 -w 0) \
        --from-literal=APP_KEY=$(echo -n "base64:$APP_KEY" | base64 -w 0) \
        --dry-run=client -o yaml | kubectl apply -f -
    
    kubectl create secret generic mysql-secret \
        --namespace=$NAMESPACE \
        --from-literal=mysql-root-password=$(echo -n "$MYSQL_ROOT_PASSWORD" | base64 -w 0) \
        --dry-run=client -o yaml | kubectl apply -f -
    
    print_status "Secrets created successfully"
    print_warning "Database Password: $DB_PASSWORD"
    print_warning "MySQL Root Password: $MYSQL_ROOT_PASSWORD"
    print_warning "Please save these passwords securely!"
}

# Function to deploy application
deploy_app() {
    print_step "Deploying application..."
    
    # Apply configurations in order
    kubectl apply -f k8s/deployment.yaml -n $NAMESPACE
    kubectl apply -f k8s/mysql.yaml -n $NAMESPACE
    kubectl apply -f k8s/redis.yaml -n $NAMESPACE
    kubectl apply -f k8s/scaling.yaml -n $NAMESPACE
    
    # Wait for database to be ready
    print_step "Waiting for database to be ready..."
    kubectl wait --for=condition=ready pod -l app=mysql -n $NAMESPACE --timeout=300s
    
    # Run migrations
    print_step "Running database migrations..."
    kubectl apply -f k8s/jobs.yaml -n $NAMESPACE
    kubectl wait --for=condition=complete job/aplikasi-madiun-migrate -n $NAMESPACE --timeout=300s
    
    # Apply ingress (if not localhost)
    if [ "$ENVIRONMENT" != "dev" ]; then
        kubectl apply -f k8s/ingress.yaml -n $NAMESPACE
    fi
    
    # Apply monitoring
    kubectl apply -f k8s/monitoring.yaml -n $NAMESPACE
    
    print_status "Application deployed successfully!"
}

# Function to update application
update_app() {
    print_step "Updating application..."
    
    # Build and push new image
    build_and_push_image
    
    # Update deployment with new image
    kubectl patch deployment aplikasi-madiun-app \
        -n $NAMESPACE \
        -p '{"spec":{"template":{"spec":{"containers":[{"name":"aplikasi-madiun","image":"'$REGISTRY_IMAGE'"}]}}}}'
    
    # Wait for rollout
    kubectl rollout status deployment/aplikasi-madiun-app -n $NAMESPACE --timeout=300s
    
    print_status "Application updated successfully!"
}

# Function to rollback application
rollback_app() {
    print_step "Rolling back application..."
    
    # Rollback to previous version
    kubectl rollout undo deployment/aplikasi-madiun-app -n $NAMESPACE
    
    # Wait for rollback
    kubectl rollout status deployment/aplikasi-madiun-app -n $NAMESPACE --timeout=300s
    
    print_status "Application rolled back successfully!"
}

# Function to destroy application
destroy_app() {
    print_warning "This will destroy all resources in namespace: $NAMESPACE"
    read -p "Are you sure? (y/N): " -n 1 -r
    echo
    
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        print_step "Destroying application..."
        kubectl delete namespace $NAMESPACE
        print_status "Application destroyed successfully!"
    else
        print_status "Destruction cancelled."
    fi
}

# Function to show status
show_status() {
    print_step "Application Status:"
    
    echo "Namespace: $NAMESPACE"
    echo "Pods:"
    kubectl get pods -n $NAMESPACE
    echo ""
    
    echo "Services:"
    kubectl get services -n $NAMESPACE
    echo ""
    
    echo "Ingress:"
    kubectl get ingress -n $NAMESPACE
    echo ""
    
    echo "Recent Events:"
    kubectl get events -n $NAMESPACE --sort-by='.lastTimestamp' | tail -10
}

# Function to get logs
get_logs() {
    print_step "Getting application logs..."
    kubectl logs -l app=aplikasi-madiun -n $NAMESPACE --tail=100 -f
}

# Main execution
case $ACTION in
    deploy)
        create_namespace
        generate_secrets
        build_and_push_image
        deploy_app
        show_status
        ;;
    update)
        update_app
        show_status
        ;;
    rollback)
        rollback_app
        show_status
        ;;
    destroy)
        destroy_app
        ;;
    status)
        show_status
        ;;
    logs)
        get_logs
        ;;
    *)
        print_error "Invalid action. Use: deploy, update, rollback, destroy, status, logs"
        exit 1
        ;;
esac

print_status "✅ Deployment script completed!"

# Show helpful commands
echo ""
print_status "Useful commands:"
echo "  🔍 Check status: kubectl get all -n $NAMESPACE"
echo "  📋 View logs: kubectl logs -l app=aplikasi-madiun -n $NAMESPACE -f"
echo "  🔄 Restart: kubectl rollout restart deployment/aplikasi-madiun-app -n $NAMESPACE"
echo "  📊 Port forward: kubectl port-forward svc/aplikasi-madiun-service 8080:80 -n $NAMESPACE"
echo "  🗄️ Database: kubectl port-forward svc/mysql-service 3306:3306 -n $NAMESPACE"
echo "  🔄 Update: ./deploy-k8s.sh $ENVIRONMENT update"
echo "  ↩️ Rollback: ./deploy-k8s.sh $ENVIRONMENT rollback"
