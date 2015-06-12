<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering\Video;

use Imagine\Image\ImageInterface;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderingServiceInterface;
use Massive\MediaRenderingBundle\Rendering\Exceptions\FileNotSupportedException;

class Video extends RenderServiceAbstract
{
    /**
     * @param string $source
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

        // convert
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
            case "video/mp4":
            case "video/quicktime":
               $supported =  true;
            break;
        }
        
        return $supported;
    }
}
