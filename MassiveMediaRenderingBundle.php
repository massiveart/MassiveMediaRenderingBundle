<?php

namespace Massive\Bundle\MediaRenderingBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Massive\Bundle\MediaRenderingBundle\DependencyInjection\DocumentCompilerPass;

class MassiveMediaRenderingBundle extends Bundle
{
    /**
     * {@inheritdoc} 
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new DocumentCompilerPass());
    }
}
