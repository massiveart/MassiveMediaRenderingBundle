<?php

namespace Massive\MediaRenderingBundle\Rendering\Document;

use Imagine\Image\ImageInterface;
use Massive\MediaRenderingBundle\Rendering\Exceptions\FileNotSupportedException;
use Massive\MediaRenderingBundle\Rendering\RenderingServiceInterface;
use Massive\MediaRenderingBundle\Rendering\RenderServiceAbstract;

class Document extends RenderServiceAbstract implements RenderingServiceInterface
{
    /**
     * @var RenderingServiceInterface[]; 
     */
    private $services = array();
    
    /**
     * @param string $source
     *
     * @return ImageInterface
     */
    public function render($source)
    {
        $image = null;
        $mimeType = $this->getMimeType($source);
        
        // check if mime type is supported
        if ($this->supportsMimeType($mimeType)) {
            throw new FileNotSupportedException($mimeType);
        }
        
        foreach ($this->services as $service) {
            if ($service->supportsMimeType($mimeType)) {
                $image = $service->render($source);
                break;
            }
        }
        
        return $image;
    }
    
    /**
     * @param RenderingServiceInterface $service
     */
    public function addRenderService(RenderingServiceInterface $service)
    {
        $this->services[] = $service;
    }
    
    /**
     * @param type $mimeType
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
