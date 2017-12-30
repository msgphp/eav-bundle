# Entity-Attribute-Value Bundle

A Symfony bundle for basic EAV management.

## Installation

```bash
composer require msgphp/eav-bundle
```

## Configuration

```php
<?php
// config/packages/msgphp.php

use MsgPhp\Eav\Entity\{Attribute, AttributeValue};
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $container) {
    $container->extension('msgphp_eav', [
        'class_mapping' => [
            Attribute::class => \App\Entity\Eav\Attribute::class,
            AttributeValue::class => \App\Entity\Eav\AttributeValue::class,
        ],
    ]);
};
```

And be done.

## Contributing

This repository is **READ ONLY**. Issues and pull requests should be submitted in the [main development repository](https://github.com/msgphp/msgphp).
