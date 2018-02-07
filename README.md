# pec-CMS - The Laravel Admin
Made with ❤️ by [peczis](https://github.com/mateusz-peczkowski)

## Installation Steps

### 1. Require the Package

After creating your new Laravel application you can include the pec-CMS package with the following command:

```bash
composer require peczis/pec-cms
```

### 2. Add the DB Credentials & APP_URL

Next make sure to create a new database and add your database credentials to your .env file:

```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

### 3. Run The Installer

To install pec-CMS simply run

```bash
php artisan pec-cms:install
```

This will publish all assets needed by CMS.

> Troubleshooting: **Specified key was too long error**. If you see this error message you have an outdated version of MySQL, use the following solution: https://laravel-news.com/laravel-5-4-key-too-long-error

And we're all good to go!

Start up a local development server with `php artisan serve` And, visit [http://localhost:8000/pec-cms](http://localhost:8000/pec-cms).

## Creating an Admin User

If you want to create your first user for CMS, run:

```bash
php artisan pec-cms:admin your@email.com
```

And you will be prompted for the user's name and password.

After that you will be able to login using provided data.
