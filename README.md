magiCal REST API for PHP
===============================

This repository contains the open source PHP client for magiCal REST API. Documentation can be found at: https://www.magic-calendar.com/docs

Requirements
-----

* [Sign up](https://dashboard.magic-calendar.com/register) for a free magiCal account
* Create a new API_TOKEN
* magical API client for PHP requires PHP >= 5.4.

Installation
-----
Run the Composer command to install the latest stable version of MagiCal:
```bash
composer require magical/php-rest-api
```
After installing, you need to require Composer's autoloader:
```php
require_once __DIR__ . 'vendor/autoload.php';
```

Usage
-----
* Required:
    * **API_TOKEN** - is identifier of your unique magiCal calendar.
    * **SECRET_TOKEN** - is unique authentication identifier used for API communication.
* Optional:
    * **DYNAMIC_TOKEN** - if you are using [dynamic plan](https://magic-calendar.com/pricing), you can have multiple calendars on one web site.

```php
\Magical\MagiCal::setSecretToken('st_DUzEYJoX2jacJkKHvMrL7CEZyJX1bVs');
\Magical\MagiCal::setApiToken('at_FAjxXZC5yOh7QCeOd3jgpXAVRlQtIaR');
\Magical\MagiCal::setDynamicToken('dt_kEr41T'); // only if you are using dynamic plan
```
That's easy enough. Now we can query the server. 
To create a reservation you need to first create a customer and set dates of reservation. Required information for customer are: first name, last name, email and number of adults.
Let's make reservation:
```php
$customer = new \Magical\Objects\Customer([
    'person_title' => 'mr', // values = ['mr', 'mrs', 'ms'] 
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john.doe@mail.com',
    'adults' => 2,
    'children' => 1,
    'phone' => '0123456789',
    'description' => '' 
]);

\Magical\Objects\Reservation::setDates('2019-10-05', '2019-10-09');
$response = \Magical\Objects\Reservation::create($customer);

if($response->success) {
    // See $response->reservation for details
} else {
    // Handle validation errors
    if($response->code === 422) {
        // See $response->errors for details
    }
    // Handle error
    else {
        // See $response->message for details
    }
}
```

Documentation
-----
Complete documentation, instructions, and examples are available at: https://www.magic-calendar.com/docs

## License
[MIT](https://choosealicense.com/licenses/mit/)
