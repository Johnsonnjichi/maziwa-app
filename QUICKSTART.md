# Quick Start Guide - PEDA Milk Bar System

## First-Time Setup (5 minutes)

### Step 1: Install Dependencies

```bash
composer install
npm install
```

### Step 2: Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

### Step 3: Setup Database

```bash
php artisan migrate
php artisan db:seed
```

### Step 4: Build Frontend

```bash
npm run build
```

### Step 5: Start Server

```bash
php artisan dev
```

Visit `http://localhost:8000` in your browser.

## Login Credentials

Use these credentials to login (password: `password` for all):

**Admin Access:**

- Email: `admin@peda.com`
- Can access everything

**Manager Access:**

- Email: `manager@peda.com`
- Assigned to: Main Branch
- Can manage branches and pricing

**Worker Access:**

- Email: `worker@peda.com`
- Assigned to: Main Branch
- Can perform daily operations

**Manager access includes the kitchen-production tasks**

- The manager can also create yoghurt batches and send stock transfers when those permissions remain enabled in `config/permissions.php`.

## Daily Workflow Examples

### Morning - Worker

1. Login as Worker
2. Go to **Milk Received** to log incoming milk
3. Record any **Add Expense** for morning costs

### During Day - Worker

1. Use **Record Sale** for each customer transaction
2. Track any **Record Wastage** if products are spoiled

### Evening - Worker

1. Go to **End of Day** to perform closeout
2. Enter cash on hand
3. Review variance
4. Complete closeout
5. Check **Close the Day** to see summary

### Production - Manager

1. Login as Manager
2. Use **Make Yoghurt** to create new batches
3. Use **Send Stock** to transfer products to branches

### Management - Manager

1. Login as Manager
2. Check **All Branches** for performance overview
3. Review the **Sales Dashboard** and **Sale Items Dashboard**
4. Update **Items & Prices** as needed

### Branch Stock Receipt

1. When stock arrives from kitchen
2. Login as branch worker
3. Go to **Confirm Arrival** link
4. Verify and confirm receipt

## Common Tasks

### Add a New Product

1. Login as Admin or Manager
2. Go to **Items & Prices**
3. Click "Add Product" (if available) or use database seeder
4. Enter product details and price

### Create a New Branch

1. Login as Admin
2. Use database seeder or create via tinker:

```bash
php artisan tinker
>>> App\Models\Branch::create(['name' => 'New Branch', 'location' => 'Address', 'phone' => '123456', 'manager_name' => 'Manager Name'])
```

### View Daily Sales

1. Login as Manager
2. Go to **All Branches**
3. View sales summary for each branch

### Handle Stock Transfer

1. Manager: **Send Stock** → Select branch and product
2. Branch: Receive notification → **Confirm Arrival** → Verify and confirm

## Troubleshooting

### "Unable to locate file in Vite manifest"

```bash
npm run build
```

### Database connection error

```bash
php artisan migrate:fresh --seed
```

### Login not working

- Ensure you ran `php artisan db:seed`
- Check email is correct
- Password is `password` for all test users

### Routes not working

```bash
php artisan route:clear
php artisan wayfinder:generate
```

## Development Tips

### Hot Reload (Development)

```bash
php artisan dev
```

- Changes to Vue files auto-reload
- Changes to PHP files may need manual refresh

### Code Formatting

```bash
vendor/bin/pint --dirty --format agent
```

### View All Routes

```bash
php artisan route:list
```

### Reset Everything

```bash
php artisan migrate:fresh --seed
npm run build
```

## Need Help?

Check the full [README.md](README.md) for detailed documentation.
