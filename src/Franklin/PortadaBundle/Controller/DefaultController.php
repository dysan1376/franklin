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
    			$message = \Swift_Message::newInstance()
    		        ->setSubject($translator->trans('portada.nuevo_message'))
    		        ->setFrom($email)
    		        ->setTo('franklin@hospi.me')
    		        ->setBody(
    		            $this->renderView(
    		                'PortadaBundle:Default:mail.html.twig', array(
    		                    'message' => $message,
    		                    'name' => $name,
                                'email' => $email
    		            )),
    		            'text/html'
    		        )
    		    ;
    		    if ($this->get('mailer')->send($message)) {
        	 		//success
                    $flashBag = $this->get('session')->getFlashBag();
                    $flashBag->add('success', $name.$translator->trans('portada.success_message'));
                    new Response('success');
        	    } else {
        	 		//fail
                    $flashBag = $this->get('session')->getFlashBag();
                    $flashBag->add('info', $name.$translator->trans('portada.info_success'));
                    new Response('info');
        	    }

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

    public function vcardAction()
    {
        //Con nombres y apellidos
        $nombre1 = 'Franklin';
        $apellido1 = 'Alvear';
        

        //Con Historia clinica
        $prefix = 'Dr.';
        $telefono = '0990459900';
        //Con firma
        $title = 'Cirujano Plástico';
        $direccion1 = 'Amazonas N39-216 y Gaspar de Villarroel';
        $direccion2 = 'Pedregal N35-15 y Hernández de Girón';

        //Con avatar
        $path = 'jpg';
        $avatarUrl = 'https://franklinalvear.com/bundles/portada/img/photos/doctor/avatar-sm.jpg';

        //Con email
        $email = 'franklin@hospi.me';

        $dataArray = "BEGIN:VCARD\nVERSION:4.0\nN;CHARSET=utf-8:".$apellido1.";".$nombre1.";;".$prefix.";\nFN;CHARSET=utf-8:".$nombre1." ".$apellido1."\nORG;CHARSET=utf-8:hospi.me\nTITLE;CHARSET=utf-8:".$title."\nPHOTO;MEDIATYPE=image/".$path.":".$avatarUrl."\nTEL;TYPE=work,voice=uri:".$telefono."\nADR;WORK;CHARSET=utf-8:;;".$direccion1."\nADR;WORK;CHARSET=utf-8:;;".$direccion2."\nURL:https://franklinalvear.com\nEMAIL:".$email."\nEND:VCARD\n";
        
        $data = $dataArray;

        $size = strlen($data);

        $filename = $nombre1." ".$apellido1.".vcf";

        $response = new Response($data);

        $response->headers->set('Content-Type', 'application/octet-stream; charset=UTF-8');
        $response->headers->set('Content-Length', $size);
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '";');
        $response->headers->set('Content-Transfer-Encoding', 'binary');

        return $response;
    }
}
