<?php

namespace Massive\MediaRenderingBundle\Rendering\Image;

use Massive\MediaRenderingBundle\Rendering\RenderingServiceInterface;
use Massive\MediaRenderingBundle\Rendering\RenderServiceAbstract;

class Image extends RenderServiceAbstract implements RenderingServiceInterface
{
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
        
        // convert
        return $image;
    }
    
    /**
     * @param type $mimeType
     *
     * @return boolean
     */
    public function supportsMimeType($mimeType)
    {
        $supported = false;
        switch ($mimeType) {
            case "image/png":
            case "image/jpeg":
            case "image/jpg":
            case "image/gif":
               $supported =  true;
            break;
        }
        
        return $supported;
    }
}

