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

The same can be done for "config" or "migrations".
