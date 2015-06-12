<?php

namespace Massive\Bundle\MediaRenderingBundle\Rendering\Exceptions;

/**
 * Class FileNotSupportedException
 */
class FileNotSupportedException extends \Exception
{
    public function __construct($message, $code, $previous)
    {
        parent::__construct('MimeType not supported: ' . $message, $code, $previous);
    }
}
