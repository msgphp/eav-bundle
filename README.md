# NOT ACTIVELY SUPPORTED ANY MORE!!

msgphp/* repositories are not actively developed/supported anymore.

**Use in production on your own risks.**

If you want to do some hotfixes - please do PR directly in target repository instead of previous msgphp/msgphp  monorepository

# Entity-Attribute-Value Bundle

A Symfony bundle for basic [EAV](https://en.wikipedia.org/wiki/Entity%E2%80%93attribute%E2%80%93value_model) management.

[![Latest Stable Version][packagist:img]][packagist]

# Installation

```bash
composer require msgphp/eav-bundle
```

# Configuration

```php
<?php
// config/packages/msgphp_eav.php

use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeValue;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $container) {
    $container->extension('msgphp_eav', [
        'class_mapping' => [
            Attribute::class => \App\Entity\Attribute::class,
            AttributeValue::class => \App\Entity\AttributeValue::class,
        ],
    ]);
};
```

# Documentation

- Read the [main documentation](https://msgphp.github.io/docs/)
- Try the Symfony [demo application](https://github.com/msgphp/symfony-demo-app)
- Get support on [Symfony's Slack `#msgphp` channel](https://symfony.com/slack-invite) or [raise an issue](https://github.com/msgphp/msgphp/issues/new)

# Contributing

[packagist]: https://packagist.org/packages/msgphp/eav-bundle
[packagist:img]: https://img.shields.io/packagist/v/msgphp/eav-bundle.svg?style=flat-square
