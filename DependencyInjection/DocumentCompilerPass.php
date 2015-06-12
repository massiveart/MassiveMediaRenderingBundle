<?php

namespace Massive\Bundle\MediaRenderingBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class DocumentCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('massive_media_rendering.document')) {
            return;
        }

        $definition = $container->findDefinition(
            'massive_media_rendering.document'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'massive_media_rendering.document'
        );
        foreach (array_keys($taggedServices) as $id) {
            $definition->addMethodCall(
                'addRenderService',
                array(new Reference($id))
            );
        }
    }
}
