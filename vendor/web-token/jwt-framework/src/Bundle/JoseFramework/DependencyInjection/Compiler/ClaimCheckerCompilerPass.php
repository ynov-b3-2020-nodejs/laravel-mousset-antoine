<?php

declare(strict_types=1);

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2019 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Jose\Bundle\JoseFramework\DependencyInjection\Compiler;

use InvalidArgumentException;
use Jose\Bundle\JoseFramework\Services\ClaimCheckerManagerFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class ClaimCheckerCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws InvalidArgumentException if the claim checker has no alias
     */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition(ClaimCheckerManagerFactory::class)) {
            return;
        }

        $definition = $container->getDefinition(ClaimCheckerManagerFactory::class);

        $taggedClaimCheckerServices = $container->findTaggedServiceIds('jose.checker.claim');
        foreach ($taggedClaimCheckerServices as $id => $tags) {
            foreach ($tags as $attributes) {
                if (!isset($attributes['alias'])) {
                    throw new InvalidArgumentException(sprintf('The claim checker "%s" does not have any "alias" attribute.', $id));
                }
                $definition->addMethodCall('add', [$attributes['alias'], new Reference($id)]);
            }
        }
    }
}
