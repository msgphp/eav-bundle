<?php

declare(strict_types=1);

namespace MsgPhp\EavBundle\DependencyInjection;

use MsgPhp\Domain\Infra\DependencyInjection\Bundle\ConfigHelper;
use MsgPhp\Eav\{AttributeIdInterface, AttributeValueIdInterface};
use MsgPhp\Eav\Entity\{Attribute, AttributeValue};
use MsgPhp\Eav\Infra\Uuid\{AttributeId, AttributeValueId};
use Ramsey\Uuid\Uuid;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root(Extension::ALIAS)
            ->append(ConfigHelper::createClassMappingNode('class_mapping', [
                Attribute::class,
                AttributeIdInterface::class => 'Try `composer require ramsey/uuid`',
                AttributeValue::class,
                AttributeValueIdInterface::class => 'Try `composer require ramsey/uuid`',
            ], function (array $value): array {
                if (class_exists(Uuid::class)) {
                    $value += [
                        AttributeIdInterface::class => AttributeId::class,
                        AttributeValueIdInterface::class => AttributeValueId::class,
                    ];
                }

                return $value;
            }));

        return $treeBuilder;
    }
}
