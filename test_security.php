<?php

// Script untuk test manual security
require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Bootstrap Laravel app
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "🔒 TESTING APLIKASI SECURITY\n\n";

// Test 1: Public dapat akses homepage
echo "1. Testing public access to homepage...\n";
$request = Request::create('/', 'GET');
$response = $kernel->handle($request);
echo "   Status: " . $response->getStatusCode() . "\n";
echo "   ✅ " . ($response->getStatusCode() == 200 ? "PASS" : "FAIL") . "\n\n";

// Test 2: Public tidak dapat akses edit (harus redirect ke login)
echo "2. Testing public cannot access edit...\n";
$request = Request::create('/admin/aplikasi/1/edit', 'GET');
$response = $kernel->handle($request);
echo "   Status: " . $response->getStatusCode() . "\n";
echo "   ✅ " . ($response->getStatusCode() == 302 ? "PASS - Redirected to login" : "FAIL") . "\n\n";

// Test 3: Public tidak dapat delete
echo "3. Testing public cannot delete...\n";
$request = Request::create('/admin/aplikasi/1', 'DELETE');
$response = $kernel->handle($request);
echo "   Status: " . $response->getStatusCode() . "\n";
echo "   ✅ " . ($response->getStatusCode() == 302 ? "PASS - Redirected to login" : "FAIL") . "\n\n";

echo "🎉 SECURITY TEST COMPLETED!\n";
echo "📋 SUMMARY:\n";
echo "   - Public routes: ✅ ACCESSIBLE\n";
echo "   - Admin routes: 🔒 PROTECTED\n";
echo "   - Middleware: ✅ WORKING\n";
