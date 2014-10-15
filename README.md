#LARAVEL FIRST DATA
##OVERVIEW
This was created as a side project for a laravel application which requires constanc first data processes. 

##INSTALLATION
To install package you have to include the following in the `composer.json`

```json
"imcorleone/laravel-first-data": "dev-master"
````

###LARAVEL 4 INTEGRATION

run the following in the `CLI`

`php artisan config:publish imcorleone/laravel-first-data`

```php
//location: app.php
'aliases' 	=> array(
	...
	'FirstData' 	=> 'Imcorleone\LaravelFirstData\Facades\Facade'
	...
),
'providers' => array(
	...
	'Imcorleone\LaravelFirstData\LaravelFirstDataServiceProvider'
	...
)

```

##CONFIGURATION
```php
	return [
		/**
		 *  DEMO FLAG /
		 *  ------------
		 *  Used to flag if the system is to use a demo entry point for 
		 *  First Data
		 */
		'demo' 	=> true,

		/**
		 * API KEY /
		 * ---------
		 * 
		 */
		'API_KEY' 	=> 'YOUR API KEY HERE',

		/**
		 * API LOGIN /
		 * -----------
		 * 
		 */
		'API_LOGIN' => 'YOUR API LOGIN'
	];

```
##FUNCTIONS
As the time of this writing and commit there is two functions that the API can process

* Pre Authentication
* Purchase

###AUTHENTICATION
```php
	$firstData = App::make('firstdata');
	$firstData->auth($cardDetails); //returns true or false
```
First Data Pre Authentication sends a **Zero Dollar Value** to the First Data Entry Point

###PURCHASE
Parameters:
* `card Details` - see card Details list
* `transaction number` - reference number for the purchase
* `amount` - the amount to be purchased using the card
```php
	$firstData = App::make('firstdata');
	$firstData->auth($cardDetails, $transNumber, $amount); 
```

###CARD DETAILS LIST

* `type` - Credit Card Type
* `number` - Credit Card Number
* `name` - Credit Card Holder Name
* `expiration` - Credit Card Expiration
* `zipcode` - Credit Card Address Zipcode
* `cvv` - Credit Card Verification Value
* `address` - Credit Card Holder Address

###CREDITS
https://github.com/VinceG/php-first-data-api
###LICENSE
The MIT License (MIT)

Copyright (c) 2013 - Vincent Gabriel

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.