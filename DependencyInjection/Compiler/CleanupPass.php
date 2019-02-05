<?php

declare(strict_types=1);

/*
 * This file is part of the MsgPHP package.
 *
 * (c) Roland Franssen <franssen.roland@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MsgPhp\EavBundle\DependencyInjection\Compiler;

use MsgPhp\Domain\Infra\DependencyInjection\ContainerHelper;
use MsgPhp\Eav\{Command, Repository};
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 *
 * @internal
 */
final class CleanupPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        ContainerHelper::removeIf($container, !$container->has(Repository\AttributeRepositoryInterface::class), [
            Command\Handler\CreateAttributeHandler::class,
            Command\Handler\DeleteAttributeHandler::class,
        ]);
    }
}
