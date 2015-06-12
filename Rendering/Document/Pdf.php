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
     * @return ImageInterface Imagine
     *
     * @throws FileNotSupportedException
     * @throws \Exception
     */
    public function render($source, RenderOptions $options, $destination = null)
    {
        $mimeType = self::getMimeType($source);
        // check if mime type is supported
        if (!$this->supportsMimeType($mimeType)) {
            throw new FileNotSupportedException($mimeType, 1, null);
        }

        if (!$options->isAllPages()) {
            $source .= '[' . $options->getPage() . ']';
        }

        $im = new \Imagick($source);
        $im->setImageFormat($options->getDestinationFormat());

        $tmpDestination = sys_get_temp_dir() . uniqid();

        if ($options->isAllPages()) {
            if ($im->writeImages($tmpDestination, false) === false) {
                throw new \Exception('Could not write temporary file ' . $tmpDestination);
            }
        } else {
            if ($im->writeImage($tmpDestination) === false) {
                throw new \Exception('Could not write temporary file ' . $tmpDestination);
            }
            $image = new Imagine();
            $handle = $image->open($tmpDestination);
            $this->resize($handle, $options);
            $handle->save($destination);
        }

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
