# Entity-Attribute-Value Bundle

A Symfony bundle for basic EAV management.

## Installation

```bash
composer require msgphp/eav-bundle
```

## Features

- Symfony 3.4 / 4.0 ready
- Doctrine persistence
- Standard supported attribute value types: `bool`, `int`, `float`, `string`, `\DateTimeInterface` and `null`

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

## Usage

### With [`DoctrineBundle`](https://github.com/doctrine/DoctrineBundle)

Repositories from `MsgPhp\Eav\Infra\Doctrine\Repository\*` are registered as a service. Corresponding domain interfaces
from  `MsgPhp\Eav\Repository\*` are aliased.

Minimal configuration:

```yaml
# config/packages/doctrine.yaml

doctrine:
    orm:
        mappings:
            app:
                dir: '%kernel.project_dir%/src/Entity'
                type: annotation
                prefix: App\Entity
```

- Requires `doctrine/orm`

## Documentation

- Read the [main documentation](https://msgphp.github.io/docs/)
- Browse the [API documentation](https://msgphp.github.io/api/MsgPhp/EavBundle.html)
- Try the Symfony [demo application](https://github.com/msgphp/symfony-demo-app)

## Contributing

This repository is **READ ONLY**. Issues and pull requests should be submitted in the
[main development repository](https://github.com/msgphp/msgphp).
