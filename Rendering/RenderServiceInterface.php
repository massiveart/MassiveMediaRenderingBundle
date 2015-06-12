<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering;

use Imagine\Image\ImageInterface;

interface RenderServiceInterface
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
     * @param RenderOptions $options
     *
     * @return ImageInterface
     */
    public function render($source, RenderOptions $options);
}
