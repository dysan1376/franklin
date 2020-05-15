<?php

namespace Franklin\UsuariosBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Franklin\UsuariosBundle\Entity\Paciente;

use Franklin\UsuariosBundle\Form\Type\PacienteType;

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

    		$paciente = $em->getRepository('UsuariosBundle:Paciente')->findOneBy( array(
                'email' => $email
            ));

            if ($paciente) {
                $paciente->setIsSubscribed(true);
                $em->persist($paciente);
                $em->flush();
            }

    		if (($email) && (!$paciente)) {
				$paciente = new Paciente();
				$paciente->setEmail($email);
		    	$paciente->setFecha(new \Datetime());
		    	$paciente->setIsSubscribed(true);
		    	$em->persist($paciente);
                $em->flush();
    		}

    		return new Response('success');

    	} else {
    		return $this->redirect($this->generateUrl('portada_homepage'));
    	}
    }

    public function asyncUnsubscribeAction(request $request)
    {
    	$em = $this->getDoctrine()->getManager();

    	if ($request->isMethod('POST')) {
    		$email = $request->request->get('email');

    		$paciente = $em->getRepository('UsuariosBundle:Paciente')->findOneBy( array(
                'email' => $email
            ));

    		if (($email) && ($paciente)) {
		    	$paciente->setIsSubscribed(false);
		    	$em->persist($paciente);
                $em->flush();
    		}

    		return new Response('success');

    	} else {
    		return $this->redirect($this->generateUrl('portada_homepage'));
    	}
    }

    public function nuevoAction()
    {
    	return $this->render('UsuariosBundle:Default:newNewsletterUser.html.twig');
    }

    public function unsubscribeAction()
    {
    	return $this->render('UsuariosBundle:Default:unsubscribeNewsletter.html.twig');
    }
}
