# CMS to Laravel 5.2

[![Total Downloads](https://poser.pugx.org/syscover/cms/downloads)](https://packagist.org/packages/syscover/cms)

## Installation

**1 - After install Laravel framework, insert on file composer.json, inside require object this value**
```
"syscover/cms": "~1.0"
```
and execute on console:
```
composer install
```

**2 - Register service provider, on file config/app.php add to providers array**

```
Syscover\Cms\CmsServiceProvider::class,

```

**3 - To publish package and migrate**

and execute composer update again:
```
composer update
```

**4 - Run seed database**

```
php artisan db:seed --class="CmsTableSeeder"
```

**5 - Activate package**

Access to Pulsar Panel, and go to Administration -> Permissions -> Profiles, and set all permissions to your profile by clicking on the open lock.<br>
Logout and loging again, to load new permissions and go to Administration -> Packages, edit the package installed and activate it