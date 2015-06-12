<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderOptions;

abstract class RenderServiceAbstract implements RenderServiceInterface
{
    /**
     * @param string $source
     *
     * @return string
     */
    public static function getMimeType($source)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $source);
        finfo_close($finfo);
        
        return $mimeType;
    }
    
    /*
     * @param ImageInterface $image
     * @param RenderOptions $options
     * @return ImageInterface
     */
    public function resize(ImageInterface $image, RenderOptions $options)
    {
        return $image->resize(new Box($options->getWidth(), $options->getHeight()));
    }
}
