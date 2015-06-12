<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering\Document;

use Imagine\Image\ImageInterface;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderOptions;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderServiceAbstract;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderServiceInterface;
use Massive\Bundle\MediaRenderingBundle\Rendering\Exceptions\FileNotSupportedException;

class Document extends RenderServiceAbstract
{
    /**
     * @var RenderServiceInterface[];
     */
    private $services = array();

    /**
     * render media to images
     *
     * @param string $source
     * @param RenderOptions $options
     *
     * @return ImageInterface|null
     *
     * @throws FileNotSupportedException
     */
    public function render($source, RenderOptions $options)
    {
        $image = null;
        $mimeType = self::getMimeType($source);
        
        // check if mime type is supported
        if ($this->supportsMimeType($mimeType)) {
            throw new FileNotSupportedException($mimeType, 1, null);
        }
        
        foreach ($this->services as $service) {
            if ($service->supportsMimeType($mimeType)) {
                $image = $service->render($source, $options);
                break;
            }
        }
        
        return $image;
    }
    
    /**
     * @param RenderServiceInterface $service
     */
    public function addRenderService(RenderServiceInterface $service)
    {
        $this->services[] = $service;
    }
    
    /**
     * @param string $mimeType
     *
     * @return boolean
     */
    public function supportsMimeType($mimeType)
    {
        $supported = false;
        foreach ($this->services as $service) {
            if ($service->supportsMimeType($mimeType)) {
                $supported = true;
            }
        }
        
        return $supported;
    }
}
