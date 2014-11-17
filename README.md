# Yourmembership PHP Api

## Install Requirements

* Laravel
* Composer
* PHP 5.4 or above


Install via Composer:
```php
"require": {
    "saiba/ymapi": "1.0.*"
},
```
Run Composer Update
```php
composer update
```

Add YmapiServiceProvider to config/app.php:
```php
'providers' => array(
    'Saiba\Ymapi\YmapiServiceProvider'
);
```

Publish the config files:
```php
php artisan config:publish saiba/ymapi
```

**edit the config files under app/config/packages/saiba/ymapi/config/config.php**
*Note the username and password, this is used as the default authentication username and password for various methods that require authentication but not an authenticated user*

## Usage


To get a list of all your event ids:
```php
<?php

use Saiba\Ymapi\Events\Event;

Route::get('/', function()
{
    $event = new Event();
    $events = $event->getIds();

    dd($events);
});
```

To search for a member: ( https://api.yourmembership.com/reference/2_00/People_All_Search.htm )

```php
<?php

use Saiba\Ymapi\People\Person;

Route::get('/', function()
{
    $params = [
        'SearchText' => 'Gerhard'
    ];

    $person = new Person();
    $result = $person->search($params);

    dd($result);
});
```

To Register a new member: ( https://api.yourmembership.com/reference/2_00/Sa_Members_Profile_Create.htm )

```php
<?php

use Saiba\Ymapi\People\Person;

Route::get('/', function()
{
    $params = [
        'EmailAddr' => 'john@example.com',
        'FirstName' => 'John',
        'LastName' => 'Doe',
        'Membership' => 'SAIBA Member & Business Accountant in Practice',
        'MembershipExpiry' => '2060-10-05 00:00:00',
        'MemberTypeCode' => '2014SAIBAMEM',
        'Username' => 'Johnd',
        'Password' => 'ThisismyPassword'
    ];

    $person = (new Person())->create($params);

    dd($person);

});
```
*Please note when creating a new member you must follow the API Precisely all capitalization should be as per the API Documentation referenced above*

**More features coming soon, this package is still under heavy development**