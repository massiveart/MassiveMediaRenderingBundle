<?php

namespace Massive\MediaRenderingBundle\Rendering;

use Imagine\Image\ImageInterface;
use Massive\MediaRenderingBundle\Rendering\Exceptions\FileNotSupportedException;
use Massive\MediaRenderingBundle\Rendering\Image\Image;
use Massive\MediaRenderingBundle\Rendering\Document\Document;
use Massive\MediaRenderingBundle\Rendering\Video\Video;
use Massive\MediaRenderingBundle\Rendering\RenderServiceAbstract;

class RenderService extends RenderServiceAbstract
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
        $mimeType = $this->getMimeType($source);

        $image = null;
        if ($this->documentService->supportsMimeType($mimeType)) {
            $image = null;
        } else if ($this->videoService->supportsMimeType($mimeType)) {
            $image = null;
        } else if ($this->imageService->supportsMimeType($mimeType)) {
            $image = null;
        }  else {
            throw new FileNotSupportedException($mimeType);
        }

        return $image;
    }
}
