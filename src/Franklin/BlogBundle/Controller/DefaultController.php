<?php

namespace Franklin\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($_locale)
    {
        return $this->render('BlogBundle:Default:blogs.html.twig');
    }

    public function slugAction($_locale)
    {
    	return $this->render('BlogBundle:Default:blog.html.twig');
    }
}
