# Blood Donation System

A Laravel-based blood donation management system that helps coordinate blood banks, donors, hospitals, and blood requests.

## Prerequisites

Make sure you have the following installed:
- PHP 8.2 or higher
- Composer
- Node.js and npm
- SQLite or MySQL

## Setup Instructions

### 1. Clone the Repository
```bash
git clone <repository-url>
cd Blood_donation_system
```

### 2. Install Dependencies

#### PHP Dependencies
```bash
composer install
```

#### JavaScript Dependencies
```bash
npm install
```

### 3. Environment Configuration
```bash
copp .env.example rename to .env
```

Edit the `.env` file with your database configuration:
```env
APP_NAME="Blood Donation System"
APP_KEY=
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# or for MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=blood_donation
# DB_USERNAME=root
# DB_PASSWORD=
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Database Migrations
```bash
php artisan migrate:fresh
```

### 6. Build Frontend Assets
```bash
npm run build
```

For development with hot reload:
```bash
npm run dev
```

### 7. Start the Development Server
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Project Structure

- `app/Models/` - Database models (User, Donor, BloodBank, Hospital, Patient, etc.)
- `app/Http/Controllers/` - Application controllers
- `database/migrations/` - Database schema migrations
- `resources/views/` - Blade templates
- `routes/web.php` - Web routes
- `config/` - Configuration files


## Troubleshooting

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
```

## License

This project is open source.
