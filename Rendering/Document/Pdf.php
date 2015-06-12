<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering\Document;

use Imagine\Image\ImageInterface;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderServiceAbstract;
use Massive\Bundle\MediaRenderingBundle\Rendering\Exceptions\FileNotSupportedException;
use Massive\Bundle\MediaRenderingBundle\Rendering\RenderOptions;
use Imagine\Imagick\Imagine;

class Pdf extends RenderServiceAbstract
{
    /**
     * render media to image
     *
     * @param string $source
     * @param RenderOptions $options
     *
     * @return Imagine
     *
     * @throws FileNotSupportedException
     * @throws \Exception
     */
    public function render($source, RenderOptions $options)
    {
        $mimeType = self::getMimeType($source);
        // check if mime type is supported
        if (!$this->supportsMimeType($mimeType)) {
            throw new FileNotSupportedException($mimeType, 1, null);
        }
        
        $im = new imagick($source . '[0]');
        $im->setImageFormat($options->getDestinationFormat());
        $tmpDestination = sys_get_temp_dir() . uniqid();
        if (file_put_contents($tmpDestination, $im) === false) {
            throw new \Exception('Could not write temporary file ' . $tmpDestination); 
        }
        
        $image = new Imagine();
        $image->open($tmpDestination);
        
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
            case 'application/pdf':
                $supported = true;
                break;
        }
        
        return $supported;
    }
}
