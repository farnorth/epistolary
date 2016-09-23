# Newsletters

Manage your newsletters and subscribers in an existing Laravel application


### Installation

Composer

```bash
composer require pilaster/newsletters
```

and then add this to `config/app.php`:

```php
Pilaster\Newsletters\Providers\NewsletterServiceProvider::class,
```

### Optional Additional Setup

To publish all of the file groups (config/views/migrations/etc.) do:

```bash
php artisan vendor:publish --provider="Pilaster\Newsletters\Providers\NewsletterServiceProvider"
```

You can specify only certain file groups by adding the `--tag` option:

```bash
--tag=views,config,migrations,factories,seeds
```

You can use also add the `--force` option at the end to overwrite older versions of any previously published file groups.

After publishing the database file groups you can migrate and seed the database with dummy test data:

```bash
php artisan migrate
```

```bash
php artisan db:seed --class=NewsletterDatabaseSeeder
```
