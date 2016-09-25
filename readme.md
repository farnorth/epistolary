# Epistolary

Manage your newsletters and subscribers in an existing Laravel application


### Installation

Composer

```bash
composer require pilaster/epistolary
```

and then add this to `config/app.php`:

```php
Pilaster\Epistolary\Providers\EpistolaryServiceProvider::class,
```

To publish all of the file groups (config/views/migrations/etc.) do:

```bash
php artisan vendor:publish --provider="Pilaster\Epistolary\Providers\EpistolaryServiceProvider"
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

#### Dummy Data

```bash
php artisan db:seed --class=NewsletterDatabaseSeeder
```

### Integrating views into your app

```
php artisan vendor:publish --tag=views
```

Then in `resources/views/vendor/epistolary/layout.blade.php`, extend your own app's layout file.

Make sure you have a `scripts` section, a `scripts` stack and a `styles` stack. Otherwise, adjust things to suit.
