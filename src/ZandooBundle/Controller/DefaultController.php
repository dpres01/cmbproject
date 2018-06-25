<?php

namespace ZandooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/zando-index")
     */
    public function indexAction()
    {      
        return $this->render('@Zandoo/Default/index.html.twig');
    }
}
