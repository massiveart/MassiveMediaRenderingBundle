<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering\Video;

use Imagine\Image\ImageInterface;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderOptions;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderServiceAbstract;
use Massive\MediaRenderingBundle\Rendering\Exceptions\FileNotSupportedException;

class Video extends RenderServiceAbstract
{
    /**
     * redner media to an image
     *
     * @param string $source
     * @param RenderOptions $options
     *
     * @return ImageInterface
     */
    public function render($source, RenderOptions $options)
    {
        $image = null;
        $mimeType = self::getMimeType($source);

        // check if mime type is supported
        if (!$this->supportsMimeType($mimeType)) {
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
