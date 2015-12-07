# yii2-gon

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

Push data from PHP controller to global JS variable (inspired by https://github.com/gazay/gon)

## Install

Via Composer

```bash
$ composer require ijackua/yii2-gon
```

## Configure
Add component to application config
```php
'components' => array(
    'gon' => 'ijackua\gon\GonComponent'
),
```
And to app `bootstrap` section
```php
$config = array(
    'bootstrap' => array('gon'),
    ...
```


Full component configuration example
```php
'components' => array(
       'gon' => array(
            'class' => 'ijackua\gon\GonComponent',
            'jsVariableName' => 'gon',
            'globalData' => ['g1' => 1, 'g2' => '2'],
            'showEmptyVar' => true,
        )
),
```



## Usage

Anywhere in your app `push` key -> value

```php
\Yii::$app->gon->push('someObj', ['a'=>'b']);
\Yii::$app->gon->push('str', 'hello');
```

On JS side you will get
```js
> window.gon
>> Object
      someObj: Object
         {
           a: "b"
         }
      str: "hello"
```


## TODO

* Make optional non-global usage. AMD, CommonJS modules.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Ievgen Kuzminov][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/ijackua/yii2-gon.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ijackua/yii2-gon.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/ijackua/yii2-gon
[link-downloads]: https://packagist.org/packages/ijackua/yii2-gon
[link-author]: https://github.com/iJackUA
[link-contributors]: ../../contributors
