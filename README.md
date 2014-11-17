# Yourmembership PHP Api

## Install Requirements

* Laravel
* Composer
* PHP 5.4 or above


Install via Composer:
```php
    "require": {
            "saiba/ymapi": "dev-master"
        },
```
Run Composer Update


Add YmapiServiceProvider to config/app.php:
```php
	'providers' => array(
            'Saiba\Ymapi\YmapiServiceProvider'
            );
```

## Usage


To get a list of all your event ids:
```php
<?php

use Saiba\Ymapi\Core\Check;
use Saiba\Ymapi\Events\Event;

Route::get('/', function()
{
	$events = ( new Event())->getIds();
    $check = ( new Check())->result($events);

    while (! $check ) {
        $events = ( new Event())->getIds();
    }

    dd($events);

});
```

To search for a member: ( https://api.yourmembership.com/reference/2_00/People_All_Search.htm )

```php
<?php

use Saiba\Ymapi\Core\Check;
use Saiba\Ymapi\People\Person;

Route::get('/', function()
{
    $terms = [
        'SearchText' => 'John'
    ];

    $person = (new Person())->search($terms);
    $check = ( new Check())->result($person);

    while (! $check ) {
        $person = (new Person())->search($terms);
    }

    dd($person);

});
```

To Register a new member: ( https://api.yourmembership.com/reference/2_00/Sa_Members_Profile_Create.htm )

```php
<?php

use Saiba\Ymapi\Core\Check;
use Saiba\Ymapi\People\Person;

Route::get('/', function()
{
    $params = [
        'EmailAddr' => 'demo@yourmembership.com',
        'FirstName' => 'Elizabeth',
        'LastName' => 'Allen',
        'Password' => 'password'
    ];

    $person = (new Person())->create($params);
    $check = ( new Check())->result($person);

    while (! $check ) {
        $person = (new Person())->create($params);
    }

    dd($person);

});
```
**Please note when creating a new member you must follow the API Precisely all capitalization should be as per the API Documentation referenced above**