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

To publish all of the file groups (assets/views/migrations/etc.) do:

```
php artisan vendor:publish --provider="Pilaster\Newsletters\Providers\NewsletterServiceProvider"
```

or to publish just the views:

```
php artisan vendor:publish --provider="Pilaster\Newsletters\Providers\NewsletterServiceProvider" --tag="views"
```

The same can be done for config, migrations, factories, and seeds. i.e.:

```
--tag=views,config,migrations,factories,seeds
```

You can use `--force` at the end to overwrite older versions of any published file groups.

After publishing the database file groups you can migrate and seed the database with dummy test data:

```
php artisan migrate
```

```
php artisan db:seed --class=NewsletterDatabaseSeeder
```
