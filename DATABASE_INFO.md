# 🗄️ DATABASE INFORMATION

## ✅ **KONFIGURASI DATABASE APLIKASI KABUPATEN MADIUN**

### 📊 **Database Engine:**
**MySQL 8.0.43** (Ubuntu 22.04.1)

### 🔧 **Konfigurasi Connection:**
- **Driver:** `mysql`
- **Host:** `127.0.0.1` (localhost)
- **Port:** `3306` (default MySQL port)
- **Database:** `aplikasi_madiun`
- **Username:** `laravel`
- **Password:** `password123`
- **Charset:** `utf8mb4`
- **Collation:** `utf8mb4_unicode_ci`

---

## 📁 **Struktur Database:**

### 🏗️ **Total Tables: 11**
| Table | Size | Description |
|-------|------|-------------|
| **aplikasis** | 32.00 KB | 📱 **Main table** - Data aplikasi OPD |
| **opds** | 16.00 KB | 🏛️ **Organization** - Data Perangkat Daerah |
| **users** | 32.00 KB | 👤 **Authentication** - Admin users |
| **sessions** | 48.00 KB | 🔑 **Session storage** |
| **cache** | 16.00 KB | ⚡ **Cache system** |
| **cache_locks** | 16.00 KB | 🔒 **Cache locking** |
| **migrations** | 16.00 KB | 📋 **Schema versioning** |
| **jobs** | 16.00 KB | ⏰ **Queue jobs** |
| **job_batches** | 16.00 KB | 📦 **Batch jobs** |
| **failed_jobs** | 16.00 KB | ❌ **Failed queue jobs** |
| **password_reset_tokens** | 16.00 KB | 🔄 **Password reset** |

### **📈 Total Database Size: 240.00 KB**

---

## 🎯 **Core Tables Structure:**

### **📱 aplikasis (Main Table)**
```sql
CREATE TABLE aplikasis (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    opd_id BIGINT,                                    -- FK to opds table
    nama_aplikasi VARCHAR(255),                       -- Application name
    deskripsi_singkat TEXT,                          -- Description
    alamat_domain VARCHAR(255) NULLABLE,             -- Domain/URL
    jenis_aplikasi ENUM(                             -- Application type
        'Aplikasi Khusus/Daerah', 
        'Aplikasi Pusat/Umum', 
        'Aplikasi Lainnya'
    ),
    status_aplikasi ENUM('Aktif', 'Tidak Aktif'),   -- Status
    penyebab_tidak_aktif TEXT NULLABLE,             -- Reason if inactive
    nama_pengelola VARCHAR(255),                     -- Manager name
    nomor_wa_pengelola VARCHAR(255),                 -- WhatsApp number
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (opd_id) REFERENCES opds(id)
);
```

### **🏛️ opds (Organization Table)**
```sql
CREATE TABLE opds (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    nama_opd VARCHAR(255),                           -- OPD name
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### **👤 users (Authentication Table)**
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    email_verified_at TIMESTAMP NULLABLE,
    password VARCHAR(255),
    remember_token VARCHAR(100) NULLABLE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

## 🔧 **Database Features:**

### **✅ Laravel Database Features Used:**
- **🔄 Migrations** - Schema versioning dan deployment
- **🏭 Eloquent ORM** - Object-Relational Mapping
- **🔑 Foreign Keys** - Referential integrity (opd_id → opds.id)
- **📋 Enums** - Constrained values untuk jenis_aplikasi & status_aplikasi
- **💾 Sessions** - Database-based session storage
- **⚡ Cache** - Database cache driver
- **📬 Queue** - Database queue driver untuk background jobs

### **🛡️ Security Features:**
- **🔐 Password Hashing** - Bcrypt dengan 12 rounds
- **🔑 CSRF Protection** - Built-in CSRF tokens
- **✅ SQL Injection Prevention** - Prepared statements via Eloquent
- **🚪 Authentication** - Laravel's built-in auth system

---

## 📊 **Database Performance:**

### **🚀 Optimization Features:**
- **📇 Indexes** - Primary keys dan foreign keys
- **🔗 Relationships** - Efficient JOIN operations via Eloquent
- **⚡ Query Builder** - Optimized query generation
- **💾 Connection Pooling** - Laravel's connection management

### **📈 Current Status:**
- **✅ Active Connections:** 1
- **📦 Total Size:** 240 KB (very efficient)
- **🏗️ Schema Version:** Up to date with migrations
- **🔄 Backup Ready** - Standard MySQL backup procedures apply

---

## 🔄 **Migration History:**

### **📋 Applied Migrations:**
1. `create_users_table` - Authentication system
2. `create_cache_table` - Cache storage
3. `create_jobs_table` - Queue system
4. `create_opds_table` - Perangkat Daerah data
5. `create_aplikasis_table` - Main applications data
6. `modify_jenis_aplikasi_nullable` - Made jenis_aplikasi nullable
7. `update_existing_aplikasi_jenis_aplikasi` - Set default values

**STATUS: DATABASE MYSQL 8.0 BERJALAN OPTIMAL** 🎉
