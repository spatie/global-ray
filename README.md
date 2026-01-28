# spatie/global-ray - Send debug output from all PHP files to Ray

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/global-ray.svg?style=flat-square)](https://packagist.org/packages/spatie/global-ray)
[![Tests](https://github.com/spatie/global-ray/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/spatie/global-ray/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/global-ray.svg?style=flat-square)](https://packagist.org/packages/spatie/global-ray)

This package can be installed **globally** to send debug output from **any** PHP app to [Ray](https://myray.app), the desktop debugging app from [Spatie](https://spatie.be/). 

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/global-ray.jpg?t=1769610085" width="500px" />](https://spatie.be/github-ad-click/global-ray)

Ray is a desktop debugging app that keeps the instant feedback you get from console.log() and dump() but lets you use the same debugging syntax across Laravel, PHP, JavaScript and more frameworks and languages.

- Send anything you want to Ray, including HTML, arrays, queries, and Markdown files.
- View and interact with output your AI sends to Ray using our MCP server. 
- Measure performance and pause execution in PHP.
- Beautifully designed themes to match your style.

Download our free trial and send up to 20 messages each session. Enjoying Ray? Buy a license to unlock the app and get full access.

## Support us

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the global Ray via composer:

```bash
composer global require spatie/global-ray
global-ray install
```

When running `global-ray install`, we'll add a line in your `php.ini` to automatically load the functions provided by this package.

## Usage

You can use `ray()` with [all supported methods](https://myray.app/docs/php/vanilla-php/reference) in any PHP file.

The `rd()`, `dump()` and `dd()` functions will also be available in any PHP project or script.

## Using framework specific functionality

Using Laravel, WordPress, Yii, or another supported PHP framework or CMS? [Install the dedicated integration](https://myray.app/docs/getting-started/integrations) for better integration and framework-specific features. If one of those packages is detected, it will be used instead of global-ray.

## How to uninstall

To uninstall you must first issue this command:

```bash
global-ray uninstall
```

This will remove the line in `php.ini` that automatically loads `ray()` and related functions.

After that, you can uninstall the package itself using

```bash
composer global remove spatie/global-ray
```


## Troubleshooting

If all your PHP scripts suddenly terminate very early with a strange error after you upgrade PHP or switch to a different version, the global-ray might be the cause.

As mentioned before, during install we slightly modify your `php.ini`. To manually uninstall global ray, remove the script named `global-ray-loader.php` in the `auto_prepend_file` directive in `php.ini`. 

You find the location of your `php.ini` by executing this command:

```php
php --ini
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Steve Bauman](https://github.com/stevebauman)
- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
