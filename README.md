# laravel-ajax-redirector

A Laravel library for handling AJAX redirects

[![Author](http://img.shields.io/badge/author-@superbalist-blue.svg?style=flat-square)](https://twitter.com/superbalist)
[![StyleCI](https://styleci.io/repos/62887913/shield?branch=master)](https://styleci.io/repos/62887913)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/superbalist/laravel-ajax-redirector.svg?style=flat-square)](https://packagist.org/packages/superbalist/laravel-ajax-redirector)
[![Total Downloads](https://img.shields.io/packagist/dt/superbalist/laravel-ajax-redirector.svg?style=flat-square)](https://packagist.org/packages/superbalist/laravel-ajax-redirector)

This package changes the redirect response for AJAX calls from 301 or 302 to a 278 JSON response. XHR requests follow
redirects which in a lot of cases, isn't the intention. In most cases, the intention is for the browser to redirect
the client to the intended page.

For **Laravel 4**, please use version 1.0.0.

For **Laravel 5**, please use version 2.0.0+

## Installation

```bash
composer require superbalist/laravel-ajax-redirector
```

Register the service provider in app.php
```php
'providers' => [
    Superbalist\AjaxRedirector\AjaxRedirectServiceProvider::class,
]
```


## Usage

In your application, you'll continue to do redirects like you always have.
```php
return redirect()->to('/test');
```

In javascript, you'll need to watch for AJAX calls which result in HTTP 278 responses and do a client side redirect
using eg: window.location.replace(json.redirect_url);

With jQuery, this can be done using a Global AJAX Event Handler.

With AngularJS, this can be done using a $http interceptor.

The response from the server will look something like:
```
HTTP/1.1 278 unknown status
Content-Type: application/json

{"redirect_url":"http:\/\/your.site.com\/test"}
```
