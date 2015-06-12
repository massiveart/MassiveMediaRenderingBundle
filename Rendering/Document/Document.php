<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering\Document;

use Imagine\Image\ImageInterface;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderingServiceInterface;

class Document implements RenderingServiceInterface
{
    /**
     * @param string $source
     *
     * @return ImageInterface
     */
    public function render($source)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $source);
        finfo_close($finfo);
        
        // check if mime type is supported
        if ($this->supportsMimeType($mimeType)) {
            
        }
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
