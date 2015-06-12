<?php

namespace Massive\MediaRenderingBundle\Rendering;

use Imagine\Image\ImageInterface;

interface RenderingServiceInterface
{
    /**
     * return whether the mime type is supported or not
     *
     * @param string $mimeType
     *
     * @return bool
     */
    public function supportsMimeType($mimeType);
    
    /**
     * redner media to an image
     * 
     * @param string $source
     * 
     * @return ImageInterface
     */
    public function render($source);
}