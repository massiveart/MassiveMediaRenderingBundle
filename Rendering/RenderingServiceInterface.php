<?php

namespace Massive\MediaRenderingBundle\Rendering;

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
}