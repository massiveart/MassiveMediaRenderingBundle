<?php

namespace Massive\Bundle\MediaRenderingBundle\Command;

use Massive\Bundle\MediaRenderingBundle\Rendering\RenderOptions;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GenericRenderCommand
 */
class GenericRenderCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('massive:render')
            ->setDescription('Renders an image from given source to file destination')
            ->addArgument(
                'source',
                InputArgument::REQUIRED,
                'source url or file path'
            )
            ->addArgument(
                'destination',
                InputArgument::REQUIRED,
                'destination file path'
            )
            ->addArgument(
                'width',
                InputArgument::REQUIRED,
                'resulting image width'
            )
            ->addArgument(
                'height',
                InputArgument::REQUIRED,
                'resulting image height'
            )
            ->addArgument(
                'keepRatio',
                InputArgument::OPTIONAL,
                'keep original ratio?',
                true
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $source = $input->getArgument('source');
        $destination = $input->getArgument('destination');
        $width = $input->getArgument('width');
        $height = $input->getArgument('height');
        $keepRatio = $input->getArgument('keepRatio');


        $options = new RenderOptions();
        $options->setWidth($width);
        $options->setHeight($height);
        $options->setKeepRatio($keepRatio);

        $this->getContainer()->get('massive_media_rendering.generic')->render($source, $options, $destination);
    }
}
