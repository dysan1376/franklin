<?php

namespace Franklin\PortadaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Franklin\PortadaBundle\Entity\Message;

use Franklin\PortadaBundle\Form\Type\MessageType;

class DefaultController extends Controller
{
    public function indexAction($_locale, Request $request)
    {
    	$message = new Message();
    	$form = $this->createForm(new MessageType(), $message);

    	if ($request->isMethod('POST')) {
        	$form->bind($request);
        	$translator = $this->get('translator');
        	if ($form->isValid()) {

        		$email = $form["email"]->getData();
    		    $name = $form["name"]->getData();
    		    $message = $form["message"]->getData();

        		//Send email
    			// $message = \Swift_Message::newInstance()
    		 //        ->setSubject($translator->trans('portada.nuevo_message'))
    		 //        ->setFrom($email)
    		 //        ->setTo('franklin@hospi.me')
    		 //        ->setBody(
    		 //            $this->renderView(
    		 //                'PortadaBundle:Default:mail.html.twig', array(
    		 //                    'message' => $message,
    		 //                    'name' => $name
    		 //                    )
    		 //            ),
    		 //            'text/html'
    		 //        )
    		 //    ;
    		 //    if ($this->get('mailer')->send($message)) {
        	 //		//success
        	 //    } else {
        	 //		//fail
        	 //    }

        		$flashBag = $this->get('session')->getFlashBag();
        		//$flashBag->add('success', $email);
            	$flashBag->add('success', $name.$translator->trans('portada.success_message'));
				new Response('success');
			} else {
				$flashBag = $this->get('session')->getFlashBag();
				$flashBag->add('info', $name.$translator->trans('portada.info_success'));
				new Response('info');
			}
		}

        return $this->render('PortadaBundle:Default:index.html.twig', array(
        	'form'=>$form->createView()
        ));
    }

    public function servicioAction($servicio, $_locale, Request $request)
    {

    	$message = new Message();
    	$form = $this->createForm(new MessageType(), $message);

    	if ($request->isMethod('POST')) {
        	$form->bind($request);
        	$translator = $this->get('translator');
        	if ($form->isValid()) {

        		$email = $form["email"]->getData();
    		    $name = $form["name"]->getData();
    		    $message = $form["message"]->getData();

        		//Send email
    			// $message = \Swift_Message::newInstance()
    		 //        ->setSubject($translator->trans('portada.nuevo_message'))
    		 //        ->setFrom($email)
    		 //        ->setTo('franklin@hospi.me')
    		 //        ->setBody(
    		 //            $this->renderView(
    		 //                'PortadaBundle:Default:mail.html.twig', array(
    		 //                    'message' => $message,
    		 //                    'name' => $name
    		 //                    )
    		 //            ),
    		 //            'text/html'
    		 //        )
    		 //    ;
    		 //    if ($this->get('mailer')->send($message)) {
        	 //		//success
        	 //    } else {
        	 //		//fail
        	 //    }

        		$flashBag = $this->get('session')->getFlashBag();
        		//$flashBag->add('success', $email);
            	$flashBag->add('success', $name.$translator->trans('portada.success_message'));
				new Response('success');
			} else {
				$flashBag = $this->get('session')->getFlashBag();
				$flashBag->add('info', $name.$translator->trans('portada.info_success'));
				new Response('info');
			}
		}
    	return $this->render('PortadaBundle:Servicios:'. $servicio .'.html.twig', array(
        	'form'=>$form->createView()
        ));
    }

    public function sendMessageAction($name, $email, $message)
    {
    	$message = \Swift_Message::newInstance()
            ->setSubject('Mensaje nuevo')
            ->setFrom('info@franklinalvear.com')
            ->setTo('franklin@hospi.me')
            ->setBody(
                $this->renderView(
                    'PortadaBundle:Default:mail.html.twig', array(
                        'message' => $message,
                        'name' => $name
                        )
                ),
                'text/html'
            )
        ;
        $this->get('mailer')->send($message);

        //return $this->render('FormulariosBundle:Default:promomail.html.twig');
        return new Response('success');
    }
}
