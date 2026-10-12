# PEDA Milk Bar Management System

A comprehensive milk bar management system built with Laravel 13, Inertia.js v3, and Vue 3. This application manages branches, sales, inventory, expenses, production, and stock transfers for a milk bar business.

## Features

### Role-Based Access Control

- **Admin**: Full system access, including role permission management and system configuration
- **Manager**: Branch oversight, pricing, kitchen production work, stock transfer coordination, and most operational duties except user management and system configuration
- **Worker**: Daily operations (sales, inventory, expenses, closeout)

The system is intentionally flexible: the admin can grant or revoke permissions for each role from the dedicated admin permission matrix at `/admin/permissions` and from the role map in `config/permissions.php`.

### Core Modules

- **Branch Management**: Multiple branch support with performance tracking
- **Point of Sale**: Fast sales recording with automatic calculations
- **Inventory Management**: Milk intake tracking with quality metrics
- **Expense Tracking**: Daily expense categorization and reporting
- **Production Management**: Yoghurt batch creation and tracking
- **Stock Transfers**: Inter-branch stock movement with confirmation
- **Wastage Tracking**: Product loss monitoring
- **Daily Closeout**: End-of-day reconciliation with variance reporting

## Requirements

- PHP 8.3 or higher
- Node.js 18 or higher
- Composer
- SQLite (default) or MySQL/PostgreSQL

## Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd peda-app
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

```bash
# Run migrations
php artisan migrate

# Seed database with initial data
php artisan db:seed
```

### 5. Build Frontend Assets

```bash
npm run build
```

## Running the Application

### Development Mode

```bash
# Start the development server (runs both PHP and Vite)
php artisan dev
```

The application will be available at `http://localhost:8000`

### Production Mode

```bash
# Build optimized assets
npm run build

# Start PHP server
php artisan serve
```

## Default User Credentials

The database seeder creates the following test users (password: `password`):

| Role    | Email            | Branch      |
| ------- | ---------------- | ----------- |
| Admin   | admin@peda.com   | None        |
| Manager | manager@peda.com | Main Branch |
| Worker  | worker@peda.com  | Main Branch |

## Quick Start Guide

### 1. Login

Navigate to `http://localhost:8000` and login with one of the default credentials.

### 2. Based on Your Role:

**As a Manager:**

- View **All Branches** to see performance metrics
- Manage **Items & Prices** to update product catalog

**As a Worker:**

- **Record Sale** to process customer transactions
- **Milk Received** to log incoming milk inventory
- **Add Expense** to track daily expenditures
- **Record Wastage** to document product losses
- **End of Day** to perform daily closeout
- **Close the Day** to view closeout summary

**As Manager:**

- **Make Yoghurt** to create production batches
- **Send Stock** to transfer products to branches
- **Review Sales Dashboard** to monitor sales and item movement

**As Branch Staff:**

- **Confirm Arrival** to acknowledge stock transfers

## Architecture

### Backend

- **Framework**: Laravel 13
- **Database**: SQLite (configurable)
- **Authentication**: Laravel Fortify with Passkeys support
- **API**: Inertia.js for SPA-like experience

### Frontend

- **Framework**: Vue 3 with Composition API
- **Styling**: Tailwind CSS v4
- **Components**: Reka UI
- **Icons**: Lucide Vue
- **Type Safety**: TypeScript with Wayfinder

### Database Schema

- `branches` - Store locations
- `products` - Product catalog
- `sales` & `sale_items` - Sales transactions
- `milk_inventory` - Milk intake
- `expenses` - Daily expenses
- `yoghurt_batches` - Production batches
- `stock_transfers` - Inter-branch transfers
- `wastages` - Product wastage
- `daily_closeouts` - End-of-day reconciliation
- `users` - Extended with roles

## Development

### Code Style

```bash
# Format PHP code with Laravel Pint
vendor/bin/pint --dirty --format agent

# Run type checking
npm run types:check

# Run linting
npm run check
```

### Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=TestName
```

### Generating Routes

```bash
# Regenerate Wayfinder routes after route changes
php artisan wayfinder:generate
```

### Adding New Features

1. **Create Migration**: `php artisan make:migration create_table_name`
2. **Create Model**: `php artisan make:model ModelName`
3. **Create Controller**: `php artisan make:controller ControllerName`
4. **Add Route**: Update `routes/web.php`
5. **Create Vue Page**: Add to `resources/js/pages/`
6. **Regenerate Routes**: `php artisan wayfinder:generate`
7. **Build Assets**: `npm run build`

## Performance Optimizations

- Database indexes on frequently queried columns
- Eager loading to prevent N+1 queries
- Efficient controller logic with minimal database calls
- Lazy loading for non-critical data
- Optimized asset bundling with Vite

## Security

- Role-based access control middleware
- CSRF protection
- Input validation
- SQL injection prevention via Eloquent ORM
- XSS protection via Inertia.js

## Troubleshooting

### Vite Build Issues

```bash
# Clear Vite cache
rm -rf node_modules/.vite

# Rebuild
npm run build
```

### Database Issues

```bash
# Reset database (WARNING: deletes all data)
php artisan migrate:fresh --seed
```

### Route Issues

```bash
# Clear route cache
php artisan route:clear

# Regenerate Wayfinder routes
php artisan wayfinder:generate
```

## Production Deployment

### Environment Configuration

- Set `APP_ENV=production` in `.env`
- Set `APP_DEBUG=false`
- Configure production database credentials
- Set appropriate `APP_URL`

### Build Process

```bash
# Install production dependencies
composer install --optimize-autoloader --no-dev
npm ci

# Build assets
npm run build

# Optimize application
php artisan optimize
php artisan config:cache
php artisan route:cache
```

## License

This project is proprietary software for PEDA Milk Bar.

## Support

For support and questions, please contact the development team.
