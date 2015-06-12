<?php

namespace Massive\MediaRenderingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MassiveMediaRenderingBundle:Default:index.html.twig', array('name' => $name));
    }
}
