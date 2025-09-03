# 📦 Containerization & Kubernetes Guide
# Aplikasi Data Aplikasi Kabupaten Madiun

## 🚀 Quick Start

### Prerequisites yang sudah terinstall:
- ✅ **Docker Extension** (`ms-azuretools.vscode-docker`)
- ✅ **Kubernetes Extension** (`ms-kubernetes-tools.vscode-kubernetes-tools`) 
- ✅ **YAML Extension** (`redhat.vscode-yaml`)

## 🐳 Docker Development

### 1. Development Environment
```bash
# Build dan jalankan development environment
./docker-build.sh all development

# Akses services:
# - Aplikasi: http://localhost:8000
# - phpMyAdmin: http://localhost:8080
# - MailHog: http://localhost:8025
# - Redis Commander: http://localhost:8081
```

### 2. Production Build
```bash
# Build production image
./docker-build.sh build production

# Jalankan production stack lengkap
./docker-build.sh run stack

# Akses services:
# - Aplikasi: http://localhost
# - Prometheus: http://localhost:9090
# - Grafana: http://localhost:3000 (admin/admin123)
```

### 3. Docker Commands
```bash
# Build only
./docker-build.sh build [production|development]

# Run containers
./docker-build.sh run [production|development|stack]

# View logs
./docker-build.sh logs [environment]

# Execute commands
./docker-build.sh exec [environment] [command]

# Stop containers
./docker-build.sh stop [environment]

# Cleanup old images
./docker-build.sh cleanup
```

---

## ☸️ Kubernetes Deployment

### 1. Prerequisites
```bash
# Install kubectl, helm, dan setup cluster connection
kubectl cluster-info

# Untuk development lokal dengan minikube:
minikube start --cpus=4 --memory=8192
```

### 2. Quick Deployment
```bash
# Deploy ke production
./deploy-k8s.sh production deploy

# Deploy ke staging
./deploy-k8s.sh staging deploy

# Deploy ke development
./deploy-k8s.sh dev deploy
```

### 3. Kubernetes Operations
```bash
# Update aplikasi
./deploy-k8s.sh production update

# Rollback ke versi sebelumnya
./deploy-k8s.sh production rollback

# Check status
./deploy-k8s.sh production status

# View logs
./deploy-k8s.sh production logs

# Destroy deployment
./deploy-k8s.sh production destroy
```

### 4. Manual Kubernetes Commands
```bash
# Apply all configurations
kubectl apply -f k8s/ -n aplikasi-madiun

# Check pods
kubectl get pods -n aplikasi-madiun

# Port forward untuk testing
kubectl port-forward svc/aplikasi-madiun-service 8080:80 -n aplikasi-madiun

# Scale aplikasi
kubectl scale deployment aplikasi-madiun-app --replicas=5 -n aplikasi-madiun

# View resources
kubectl get all -n aplikasi-madiun
```

---

## 📁 File Structure

```
📦 Container & K8s Files
├── 🐳 Docker Files
│   ├── Dockerfile                 # Production multi-stage build
│   ├── Dockerfile.dev            # Development dengan hot reload
│   ├── docker-compose.yml        # Production stack
│   ├── docker-compose.dev.yml    # Development stack
│   └── docker/
│       ├── php/                  # PHP configurations
│       ├── nginx/                # Nginx configurations
│       └── supervisor/           # Process supervisor
│
├── ☸️ Kubernetes Manifests
│   ├── deployment.yaml           # App deployment & services
│   ├── mysql.yaml                # Database deployment
│   ├── redis.yaml                # Cache deployment
│   ├── ingress.yaml              # Load balancer & SSL
│   ├── scaling.yaml              # HPA & resource limits
│   ├── jobs.yaml                 # Migrations & cron jobs
│   └── monitoring.yaml           # Prometheus & Grafana
│
└── 🛠️ Scripts
    ├── docker-build.sh           # Docker management
    ├── deploy-k8s.sh             # Kubernetes deployment
    └── install.sh                # Traditional server install
```

---

## 🔧 Configuration

### Environment Variables
```bash
# Production
APP_ENV=production
APP_DEBUG=false
DB_HOST=mysql-service
REDIS_HOST=redis-service

# Development
APP_ENV=local
APP_DEBUG=true
DB_HOST=mysql
REDIS_HOST=redis
```

### Resource Requirements

#### Minimum (Development)
- **CPU**: 2 cores
- **Memory**: 4GB RAM
- **Storage**: 20GB

#### Recommended (Production)
- **CPU**: 4+ cores
- **Memory**: 8GB+ RAM
- **Storage**: 100GB+ SSD

#### Kubernetes Cluster
- **Nodes**: 3+ nodes
- **Per Node**: 4 CPU, 8GB RAM
- **Storage Class**: SSD dengan ReadWriteMany support

---

## 🚀 Deployment Strategies

### 1. Development Workflow
```bash
# 1. Start development environment
./docker-build.sh all development

# 2. Code changes with hot reload
# Files are mounted, changes reflect immediately

# 3. Test dan debug
./docker-build.sh logs development
```

### 2. Staging Deployment
```bash
# 1. Build dan test
./docker-build.sh build production

# 2. Deploy ke staging
./deploy-k8s.sh staging deploy

# 3. Run tests
kubectl exec -it deployment/aplikasi-madiun-app -n aplikasi-madiun-staging -- php artisan test
```

### 3. Production Deployment
```bash
# 1. Tag release
git tag v1.0.1
git push origin v1.0.1

# 2. Deploy dengan rolling update
./deploy-k8s.sh production update

# 3. Verify deployment
./deploy-k8s.sh production status
```

---

## 📊 Monitoring & Observability

### Metrics Available
- **Application**: Response time, request rate, error rate
- **Infrastructure**: CPU, memory, disk, network
- **Database**: Query performance, connections
- **Cache**: Hit rate, evictions

### Health Checks
- **Liveness**: `/health` endpoint
- **Readiness**: Database connectivity
- **Startup**: Application initialization

### Logging
- **Application logs**: Laravel logs ke stderr
- **Infrastructure logs**: Kubernetes events
- **Audit logs**: Deployment history

---

## 🔒 Security Features

### Container Security
- ✅ Non-root user (UID 1000)
- ✅ Read-only filesystem
- ✅ Security headers
- ✅ Minimal attack surface

### Kubernetes Security
- ✅ Network policies
- ✅ RBAC configuration
- ✅ Pod security policies
- ✅ Secret management

### SSL/TLS
- ✅ Let's Encrypt integration
- ✅ TLS 1.2+ only
- ✅ Strong cipher suites
- ✅ HSTS headers

---

## 🔄 Backup & Recovery

### Database Backup
```bash
# Manual backup
kubectl exec -it deployment/mysql -n aplikasi-madiun -- mysqldump aplikasi_madiun > backup.sql

# Automated backup (CronJob sudah dikonfigurasi)
kubectl get cronjob -n aplikasi-madiun
```

### Disaster Recovery
```bash
# 1. Backup secrets dan configs
kubectl get secrets,configmaps -n aplikasi-madiun -o yaml > backup-configs.yaml

# 2. Restore dari backup
kubectl apply -f backup-configs.yaml
./deploy-k8s.sh production deploy
```

---

## 🐛 Troubleshooting

### Common Issues

#### Container tidak start
```bash
# Check logs
./docker-build.sh logs production

# Check resources
docker stats

# Rebuild image
./docker-build.sh build production
```

#### Pod CrashLoopBackOff
```bash
# Check pod logs
kubectl logs -f deployment/aplikasi-madiun-app -n aplikasi-madiun

# Check events
kubectl get events -n aplikasi-madiun --sort-by=.lastTimestamp

# Describe pod
kubectl describe pod <pod-name> -n aplikasi-madiun
```

#### Database connection issues
```bash
# Test database connectivity
kubectl exec -it deployment/mysql -n aplikasi-madiun -- mysql -u root -p

# Check service discovery
kubectl get svc -n aplikasi-madiun
kubectl get endpoints -n aplikasi-madiun
```

### Performance Tuning

#### PHP-FPM Optimization
- Adjust `pm.max_children` based on memory
- Monitor `pm.status_path` untuk metrics
- Enable OPcache dengan proper settings

#### MySQL Optimization
- Configure `innodb_buffer_pool_size`
- Monitor slow query log
- Optimize indexes

#### Redis Optimization
- Set proper `maxmemory` dan `maxmemory-policy`
- Monitor memory usage
- Configure persistence appropriately

---

## 📚 Additional Resources

### VS Code Extensions (Sudah Terinstall)
```vscode-extensions
ms-azuretools.vscode-docker,ms-kubernetes-tools.vscode-kubernetes-tools,redhat.vscode-yaml
```

### Useful Links
- [Kubernetes Documentation](https://kubernetes.io/docs/)
- [Docker Best Practices](https://docs.docker.com/develop/best-practices/)
- [Laravel Deployment](https://laravel.com/docs/deployment)

### Commands Reference
```bash
# Docker
docker ps                          # List containers
docker images                      # List images
docker logs <container>            # View logs
docker exec -it <container> bash   # Execute shell

# Kubernetes
kubectl get all -n <namespace>     # List resources
kubectl describe <resource>        # Resource details
kubectl logs -f <pod>             # Follow logs
kubectl port-forward <svc> 8080:80 # Port forwarding
```

---

**🎉 Ready for Containerized Deployment!**

Aplikasi Data Aplikasi Kabupaten Madiun sekarang fully containerized dengan Docker dan siap untuk deployment ke Kubernetes dengan semua best practices untuk production environment.
