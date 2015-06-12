<?php

namespace Massive\MediaRenderingBundle\Rendering\Document;

use Imagine\Image\ImageInterface;
use Massive\MediaRenderingBundle\Rendering\RenderingServiceInterface;

class Pdf extends RenderServiceAbstract implements RenderingServiceInterface
{
    /*
     * @param string source
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
        
        // do converting
        
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
            case "application/pdf":
                $supported = true;
                break;
        }
        
        return $supported;
    }
}
