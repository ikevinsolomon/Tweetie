# Tweetie

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A simple client to wrap around Twitters API's

## Structure

```
bin/
config/
src/
tests/
vendor/
```


## Install

Via Composer

``` bash
$ composer require KevinSolomon/Tweetie
```

## Usage

``` php
$tweetie_client = new KevinSolomon\Tweetie();
echo $tweetie_client->echoPhrase('Hello, World!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email ikevinsolomon@gmail.com instead of using the issue tracker.

## Credits

- [Kevin Solomon][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/KevinSolomon/Tweetie.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/KevinSolomon/Tweetie/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/KevinSolomon/Tweetie.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/KevinSolomon/Tweetie.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/KevinSolomon/Tweetie.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/KevinSolomon/Tweetie
[link-travis]: https://travis-ci.org/KevinSolomon/Tweetie
[link-scrutinizer]: https://scrutinizer-ci.com/g/KevinSolomon/Tweetie/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/KevinSolomon/Tweetie
[link-downloads]: https://packagist.org/packages/KevinSolomon/Tweetie
[link-author]: https://github.com/ikevinsolomon
[link-contributors]: ../../contributors
