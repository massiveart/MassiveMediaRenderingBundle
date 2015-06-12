<?php

namespace Massive\MediaRenderingBundle\Rendering;

class RenderServiceAbstract
{
    /**
     * @param type $source
     * 
     * @return string
     */
    public function getMimeType($source)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $source);
        finfo_close($finfo);
        
        return $mimeType;
    }
}