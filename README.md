cocur/human-date
================

> Transforms dates into a human-readable format.

[![Latest Stable Version](http://img.shields.io/packagist/v/cocur/human-date.svg)](https://packagist.org/packages/cocur/human-date)
[![Build Status](http://img.shields.io/travis/cocur/human-date.svg)](https://travis-ci.org/cocur/human-date)
[![Code Coverage](http://img.shields.io/coveralls/cocur/human-date.svg)](https://coveralls.io/r/cocur/human-date)


Features
--------

- Transforms dates into a human-readable format
- No external dependencies.
- PSR-4 compatible.
- Compatible with PHP >= 5.4 and [HHVM](http://hhvm.com).
- Integrations for [Symfony2](http://symfony.com) and [Twig](http://twig.sensiolabs.org).


Installation
------------

You can install `cocur/human-date` using [Composer](https://getcomposer.org):

```shell
$ composer require cocur/human-date:@stable
```

*In a production environment you should replace `@stable` with the [version](https://github.com/cocur/human-date/releases) you want to use.*


Usage
-----

You can pass an instance of `DateTime` to the `HumanDate::transform()` method. For example, assuming that today is `2012-08-18`:

```php

use Cocur\HumanDate\HumanDate;

$humanDate = new HumanDate();

echo $humanDate->transform(new DateTime('now'));
// 'Today'

echo $humanDate->transform(new DateTime('+1 day'));
// 'Tomorrow'

echo $humanDate->transform(new DateTime('-1 day'));
// 'Yesterday'

echo $humanDate->transform(new DateTime('2012-08-21'));
// 'Next Tuesday'

echo $humanDate->transform(new DateTime('2012-09-30'));
// 'September 30'

echo $humanDate->transform(new DateTime('2013-03-30'));
// 'March 30, 2013'
```


Bridges
-------

`cocur/human-date` contains bridges for Symfony and Twig.

### Symfony

The Symfony bridge provides you with a bundle and an extension to use `HumanDate` as a service in your application.

```php
# app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Cocur\HumanDate\Bridge\Symfony\CocurHumanDateBundle(),
        );
        // ...
    }

    // ...
}
```

You can now use the `cocur_human_date` service everywhere in your application, for example, in your controller:

```php
$slug = $this->get('cocur_human_date')->slugify(new DateTime('2014-04-14'));
```

The bundle also provides an alias `human_date` for the `cocur_human_date` service:

```php
$slug = $this->get('human_date')->slugify(new DateTime('2014-04-14'));
```

### Twig

If you use the Symfony2 framework with Twig you can use the Twig filter `humanDate` in your templates after you have setup Symfony2 integrations (see above).

```twig
{{ post.createdAt|humanDate }}
```

If you use Twig outside of the Symfony2 framework you first need to add the extension to your environment:

```php
use Cocur\HumanDate\Bridge\Twig\HumanDateExtension;
use Cocur\HumanDate\HumanDate;

$twig = new Twig_Environment($loader);
$twig->addExtension(new HumanDateExtension(new HumanDate()));
```

You can find more information about registering extensions in the [Twig documentation](http://twig.sensiolabs.org/doc/advanced.html#creating-an-extension).


Changelog
---------

### Version 0.1 (14 May 2014)

- Initial version (ported from `BraincraftedHumanDateBundle`)


Authors
-------

- [Florian Eckerstorfer](http://florian.ec) ([Twitter](http://twitter.com/Florian_))  [![Support Florian](http://img.shields.io/gittip/florianeckerstorfer.svg)](https://www.gittip.com/FlorianEckerstorfer/)


License
-------

The MIT License (MIT)
Copyright (c) 2012 Florian Eckerstorfer

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
