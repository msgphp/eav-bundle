<?php

declare(strict_types=1);

namespace MsgPhp;

use MsgPhp\Domain\Infra\DependencyInjection\Bundle\ContainerHelper;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/** @var ContainerBuilder $container */
$container = $container ?? (function (): ContainerBuilder { throw new \LogicException('Invalid context.'); })();
$reflector = ContainerHelper::getClassReflector($container);
$pattern = '%kernel.project_dir%/vendor/msgphp/eav/Infra/Doctrine/Repository/*Repository.php';
$repositories = $container->getParameterBag()->resolveValue($pattern);

return function (ContainerConfigurator $container) use ($reflector, $repositories, $pattern): void {
    $services = $container->services()
        ->defaults()
            ->autowire()
            ->private()

        ->load($ns = 'MsgPhp\\Eav\\Infra\\Doctrine\\Repository\\', $pattern)
    ;

    foreach (glob($repositories) as $file) {
        foreach ($reflector($repository = $ns.basename($file, '.php'))->getInterfaces() as $interface) {
            try {
                $services->get($interface = $interface->getName());
            } catch (ServiceNotFoundException $e) {
                $services->alias($interface, $repository);
            }
        }
    }
};
