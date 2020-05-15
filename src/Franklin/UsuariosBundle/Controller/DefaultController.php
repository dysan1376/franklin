<?php

namespace Franklin\UsuariosBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Franklin\UsuariosBundle\Entity\Newsletterlist;

use Franklin\UsuariosBundle\Form\Type\NewsletterlistType;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UsuariosBundle:Default:index.html.twig', array('name' => $name));
    }

    public function asyncAction(request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	if ($request->isMethod('POST')) {
    		$email = $request->request->get('email');

    		if ($email) {
				$newsletterlist = new Newsletterlist();
				$newsletterlist->setEmail($email);
		    	$newsletterlist->setFecha(new \Datetime());
		    	$newsletterlist->setIsActive(true);
		    	$em->persist($newsletterlist);
                $em->flush();
    		}

    		return new Response('success');

    	} else {
    		return $this->redirect($this->generateUrl('portada_homepage'));
    	}
    }

    public function nuevoAction()
    {
    	return $this->render('UsuariosBundle:Default:nuevo.html.twig');
    }
}
