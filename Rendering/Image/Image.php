<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering\Image;

use Imagine\Image\ImageInterface;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderOptions;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderServiceAbstract;
use Massive\MediaRenderingBundle\Rendering\Exceptions\FileNotSupportedException;

class Image extends RenderServiceAbstract
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
        $mimeType = self::getMimeType($source);
            
        $image = null;
        
        // check if mime type is supported
        if (!$this->supportsMimeType($mimeType)) {
            throw new FileNotSupportedException($mimeType);
        }
        $image = $this->resize($image, $options);
        
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
