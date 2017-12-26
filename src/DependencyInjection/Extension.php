<?php

declare(strict_types=1);

namespace MsgPhp\EavBundle\DependencyInjection;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use MsgPhp\Domain\Infra\Bundle\ServiceConfigHelper;
use MsgPhp\Eav\{AttributeIdInterface, AttributeValueIdInterface};
use MsgPhp\Eav\Entity\{Attribute, AttributeValue};
use MsgPhp\Eav\Infra\Doctrine\Repository\AttributeRepository;
use SimpleBus\SymfonyBridge\SimpleBusCommandBusBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension as BaseExtension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class Extension extends BaseExtension
{
    public const ALIAS = 'msgphp_eav';

    public function getAlias(): string
    {
        return self::ALIAS;
    }

    public function getConfiguration(array $config, ContainerBuilder $container): ConfigurationInterface
    {
        return new Configuration();
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration($this->getConfiguration($configs, $container), $configs);
        $classMapping = $config['class_mapping'];

        $loader = new PhpFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $bundles = array_flip($container->getParameter('kernel.bundles'));

        ServiceConfigHelper::configureEntityFactory($container, $classMapping, [
            Attribute::class => AttributeIdInterface::class,
            AttributeValue::class => AttributeValueIdInterface::class,
        ]);

        if (isset($bundles[DoctrineBundle::class])) {
            $this->prepareDoctrineBundle($config, $loader, $container);
        }
    }

    private function prepareDoctrineBundle(array $config, LoaderInterface $loader, ContainerBuilder $container): void
    {
        $loader->load('doctrine.php');

        $classMapping = $config['class_mapping'];

        foreach ([
            AttributeRepository::class => $classMapping[Attribute::class] ?? null,
        ] as $repository => $class) {
            if (null === $class) {
                $container->removeDefinition($repository);
            } else {
                $container->getDefinition($repository)->setArgument('$class', $class);
            }
        }
    }
}
