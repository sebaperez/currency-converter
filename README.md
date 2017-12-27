# currency-converter
PHP Library for currency conversion using CurrencyConverterAPI

## What's included
1. src folder with a php file that you should include in your project
2. tests folder with php unit tests using PHPUnit

## Why CurrencyConverterAPI?
Because it's free, you do not need an API Key or subscribe and works good.
You have 100 requests per hour. However, the library uses a local cache, so if you use the same instance in your script you won't use your hourly-requests. Bear in mind the cache do not have an expiration time.

If you want more, you can get a paid plan.

Find pricing and documentation in [their website](https://www.currencyconverterapi.com).

## How to use it

```
$cc = new ConverterCurrency();
$cc->convert(string $from, string $to, float $amount)
```

This example will return USD 10,000 in BTC

```
$cc = new ConverterCurrency();
$cc->convert("USD", "BTC", 10000);
```

## How to run the tests

Install PHPUnit, then:

```
phpunit test_CurrencyConverter.php
```

## Need help?
Feel free to use this code. If you need to contact me, you can do it a sperez at est.frba.utn.edu.ar
