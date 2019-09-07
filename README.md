# Omnipay: Nobitex

**Nobitex driver for the Omnipay PHP payment processing library**

[![Packagist Version](https://img.shields.io/packagist/v/nekofar/omnipay-nobitex.svg)][1]
[![PHP from Packagist](https://img.shields.io/packagist/php-v/nekofar/omnipay-nobitex.svg)][1]
[![Travis (.com) branch](https://img.shields.io/travis/com/nekofar/omnipay-nobitex/master.svg)][3]
[![Codecov](https://img.shields.io/codecov/c/gh/nekofar/omnipay-nobitex.svg)][4]
[![Packagist](https://img.shields.io/packagist/l/nekofar/omnipay-nobitex.svg)][2]
[![Twitter: nekofar](https://img.shields.io/twitter/follow/nekofar.svg?style=flat)][7]

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP. This package implements Nobitex support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply require 
`league/omnipay` and `nekofar/omnipay-nobitex` with Composer:

```
composer require league/omnipay nekofar/omnipay-nobitex
```

## Basic Usage

The following gateways are provided by this package:

* Nobitex

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay)
repository.

## Example

### Purchase

The result will be a redirect to the gateway or bank.

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Nobitex');
$gateway->setApiKey('xxxxxxxx');
$gateway->setReturnUrl('https://www.example.com/return');

// Send purchase request
$response = $gateway->purchase([
    'amount' => 10000,
    'description' => 'Some description'
])->send();

// Process response
if ($response->isRedirect()) {
    // Redirect to offsite payment gateway
    $response->redirect();
} else {
    // Payment failed: display message to customer
    echo $response->getMessage();
}
```

On return, the usual completePurchase will provide the result of the transaction attempt.

The final result includes the following methods to inspect additional details:

```php
// Send purchase complete request
$response = $gateway->completePurchase([
    'token' => $_REQUEST['token'], 
)->send();

// Process response
if ($response->isSuccessful()) {
    // Payment was successful
    print_r($response);
} else {
    // Payment failed: display message to customer
    echo $response->getMessage();
}
```

### Testing

```sh
composer test
```

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/nekofar/omnipay-nobitex/issues),
or better yet, fork the library and submit a pull request.

[1]: https://packagist.org/packages/nekofar/omnipay-nobitex
[2]: https://github.com/nekofar/omnipay-nobitex/blob/master/LICENSE
[3]: https://travis-ci.com/nekofar/omnipay-nobitex
[4]: https://codecov.io/gh/nekofar/omnipay-nobitex
[5]: https://packagist.org/providers/php-http/client-implementation
[6]: https://nobitex.market
[7]: https://twitter.com/nekofar
