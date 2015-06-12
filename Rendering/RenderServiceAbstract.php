<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering;

use Massive\Bundle\MediaRenderingBundle\Rendering\ImageInterface;
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
    
    /**
     * @param type ImageInterface Description
     * @param string $destination
     */
    public function writeImage(ImageInterface $image, $destination)
    {
        if (!file_put_contents($destination, $image)) {
            
        }
    }
}
