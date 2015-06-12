<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering;

use Imagine\Image\ImageInterface;
use Massive\Bundle\MediaRenderingBundle\Rendering\Document\Document;
use Massive\Bundle\MediaRenderingBundle\Rendering\Exceptions\FileNotSupportedException;
use Massive\Bundle\MediaRenderingBundle\Rendering\Image\Image;
use Massive\Bundle\MediaRenderingBundle\Rendering\Video\Video;

class RenderService
{
    /** @var Image */
    protected $imageService;

    /** @var Document */
    protected $documentService;

    /** @var Video */
    protected $videoService;

    /**
     * @param Image $imageService
     * @param Document $documentService
     * @param Video $videoService
     */
    public function __construct(Image $imageService, Document $documentService, Video $videoService)
    {
        $this->imageService = $imageService;
        $this->documentService = $documentService;
        $this->videoService = $videoService;
    }

    /**
     * @param $source
     * @param RenderOptions $options
     * @param null $destination
     *
     * @return ImageInterface|null
     *
     * @throws FileNotSupportedException
     */
    public function render($source, RenderOptions $options, $destination = null)
    {
        $mimeType = RenderServiceAbstract::getMimeType($source);

        $image = null;
        if ($this->documentService->supportsMimeType($mimeType)) {
            $image = $this->documentService->render($source, $options);
        } else if ($this->videoService->supportsMimeType($mimeType)) {
            $image = null;
        } else if ($this->imageService->supportsMimeType($mimeType)) {
            $image = null;
        }  else {
            throw new FileNotSupportedException($mimeType, 1, null);
        }

        return $image;
    }
}
