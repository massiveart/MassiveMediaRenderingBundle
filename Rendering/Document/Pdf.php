<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering\Document;

use Imagine\Image\ImageInterface;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderServiceAbstract;

class Pdf extends RenderServiceAbstract
{
    /*
     * @param string source
     * 
     * @return ImageInterface
     */
    public function render($source)
    {
        $image = null;
        $mimeType = self::getMimeType($source);
        // check if mime type is supported
        if ($this->supportsMimeType($mimeType)) {
            throw new FileNotSupportedException($mimeType);
        }
        
        // do converting
        
        return $image;
    }
    
    /**
     * @param string $mimeType
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
