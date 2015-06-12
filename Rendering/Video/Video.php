<?php

namespace Massive\MediaRenderingBundle\Rendering\Video;

use Massive\MediaRenderingBundle\Rendering\RenderingServiceInterface;
use Massive\MediaRenderingBundle\Rendering\RenderServiceAbstract;

class Video extends RenderServiceAbstract implements RenderingServiceInterface
{
    /**
     * @param string $source
     *
     * @return ImageInterface
     */
    public function render($source)
    {
        $image = null;
        $mimeType = $this->getMimeType($source);

        // check if mime type is supported
        if ($this->supportsMimeType($mimeType)) {
            throw new FileNotSupportedException($mimeType);
        }

        // convert
        return $image;
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
            case "video/mp4":
            case "video/quicktime":
               $supported =  true;
            break;
        }
        
        return $supported;
    }
}
