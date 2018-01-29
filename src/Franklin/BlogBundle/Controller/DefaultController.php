<?php

namespace Franklin\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($_locale)
    {
        return $this->render('BlogBundle:Default:index.html.twig');
    }

    public function slugAction($_locale)
    {
    	return $this->render('BlogBundle:Default:slug.html.twig');
    }
}
