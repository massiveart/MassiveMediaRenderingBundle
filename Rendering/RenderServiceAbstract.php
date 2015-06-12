<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering;

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
}