magiCal REST API for PHP
===============================

This repository contains the open source PHP client for magiCal REST API. Documentation can be found at: https://magic-calendar.com/docs

Requirements
-----

* [Sign up](https://dashboard.magic-calendar.com/register) for a free magiCal account
* Create a new API_TOKEN
* magical API client for PHP requires PHP >= 5.4.

Installation
-----

```bash
composer require magical/php-rest-api
```

Usage
-----
* Required:
    * **API_TOKEN** - is identifier of your unique magiCal calendar.
    * **SECRET_TOKEN** - is unique authentication identifier used for API communication.
* Optional:
    * **DYNAMIC_TOKEN** - if you are using [dynamic plan](https://magic-calendar.com/pricing), you can have multiple calendars on one web site.

```php
require 'autoload.php';

// if you are using DYNAMIC plan, add it as the second parameter
$magiCal = new \Magical\Client('YOUR_API_TOKEN');
$magiCal->setSecretToken('YOUR_SECRET_TOKEN');
```
That's easy enough. Now we can query the server. Let's make reservation:
```php
$reservation = new \Magical\Objects\Reservation();
$reservation->setDates('2019-08-01','2019-08-10');

$magiCal->makeReservation($reservation);
```


Documentation
-----
Complete documentation, instructions, and examples are available at: https://magic-calendar.com/docs

## License
[MIT](https://choosealicense.com/licenses/mit/)
