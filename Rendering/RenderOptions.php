<?php

namespace Massive\MediaRenderingBundle\Rendering;

/**
 * Class RenderOptions
 */
class RenderOptions
{
    const OUTPUT_FORMAT_PNG = "png";
    const OUTPUT_FORMAT_JPG = "jpg";
    const OUTPUT_FORMAT_GIF = "gif";

    /** @var int */
    private $width;

    /** @var int */
    private $height;

    /** @var bool */
    private $keepRatio = true;

    /** @var string */
    private $destinationFormat = self::OUTPUT_FORMAT_PNG;

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return boolean
     */
    public function isKeepRatio()
    {
        return $this->keepRatio;
    }

    /**
     * @param boolean $keepRatio
     */
    public function setKeepRatio($keepRatio)
    {
        $this->keepRatio = $keepRatio;
    }

    /**
     * @return string
     */
    public function getDestinationFormat()
    {
        return $this->destinationFormat;
    }

    /**
     * @param string $destinationFormat
     */
    public function setDestinationFormat($destinationFormat)
    {
        $this->destinationFormat = $destinationFormat;
    }
}
