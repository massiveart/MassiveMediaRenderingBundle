<?php

namespace Massive\Bundle\MediaRenderingBundle\Command;

use Massive\Bundle\MediaRenderingBundle\Rendering\RenderOptions;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PDFRenderCommand
 */
class PDFRenderCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('massive:render:pdf')
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
                'page',
                InputArgument::OPTIONAL,
                'which page should be rendered',
                1
            )
            ->addArgument(
                'allPages',
                InputArgument::OPTIONAL,
                'true, if you want to render all pages',
                false
            )
            ->addArgument(
                'outputFormat',
                InputArgument::OPTIONAL,
                'png, gif or jpg',
                'png'
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
        // read arguments
        $source = $input->getArgument('source');
        $destination = $input->getArgument('destination');
        $width = $input->getArgument('width');
        $height = $input->getArgument('height');
        $format = $input->getArgument('outputFormat');
        $keepRatio = $input->getArgument('keepRatio');
        $allPages = $input->getArgument('allPages');
        $page = $input->getArgument('page');

        // create options
        $options = new RenderOptions();
        $options->setWidth($width);
        $options->setHeight($height);
        $options->setKeepRatio($keepRatio);
        $options->setDestinationFormat($format);
        $options->setAllPages($allPages);
        $options->setPage($page-1); // -1 because in service we want to use the index of the page

        $this->getContainer()->get('massive_media_rendering.generic')->render($source, $options, $destination);
    }
}
