# Newsletters

Manage your newsletters and subscribers in an existing Laravel application


### Installation

Add this to `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:PilasterDigital/newsletters.git"
        }
    ],
    "require": {
        "pilaster/newsletters": "dev-master@dev"
    }
}
```

and then do,

```bash
composer update pilaster/newsletters
```

and then add this to `config/app.php`:

```php
Pilaster\Newsletters\Providers\NewsletterServiceProvider::class,
```
