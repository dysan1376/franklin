<?php

namespace Franklin\PortadaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Franklin\PortadaBundle\Entity\Message;

use Franklin\PortadaBundle\Form\Type\MessageType;

class DefaultController extends Controller
{
    public function indexAction($_locale, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $blogsAll = $em->getRepository('BlogBundle:Blog')->findAll();
        $blogs = array_slice($blogsAll,0,6,false);

        $session = $this->container->get('session')->start();
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
                    //new Response('success');
        	    } else {
        	 		//fail
                    $flashBag = $this->get('session')->getFlashBag();
                    $flashBag->add('info', $name.$translator->trans('portada.info_success'));
                    //new Response('info');
        	    }

			} else {
				$flashBag = $this->get('session')->getFlashBag();
				$flashBag->add('info', $name.$translator->trans('portada.info_success'));
				//new Response('info');
			}
		}

        return $this->render('PortadaBundle:Default:index.html.twig', array(
        	'form'=>$form->createView(),
            'blogs' => $blogs
        ));
    }

    public function localeAction($_locale, Request $request)
    {

        $request = $this->getRequest();
        $user = $this->container->get('security.context')->getToken()->getUser();
        $referer = $request->server->get('HTTP_REFERER');
        
        if ( ($user == 'anon.') || ($referer == "https://franklinalvear.com") || ( preg_match("~\bpt\b~",$referer)) || ( preg_match("~\ben\b~",$referer)) || ( preg_match("~\bes\b~",$referer)) || ( preg_match("~\bit\b~",$referer)) ) {
            
            $lastPath = substr($referer, strpos($referer, $this->container->get('request')->getSchemeAndHttpHost()));
            $lastPath = str_replace($this->container->get('request')->getSchemeAndHttpHost(), '', $lastPath);

            // get last route
            $matcher = $this->get('router')->getMatcher();
            $parameters = $matcher->match($lastPath);
            
            // set new locale (to session and to the route parameters)
            $parameters['_locale'] = $_locale;
            $parameters['_route'] = "portada_homepage";

            $request->setLocale($request->getSession()->set('_locale', $_locale));

            // default parameters has to be unsetted!
            $route = $parameters['_route'];
            unset($parameters['_route']);
            unset($parameters['_controller']);

            return $this->redirect($this->generateUrl($route, $parameters));
        } else {
            return $this->redirect($this->generateUrl('portada_homepage'));
        }
        
    }

    public function servicioAction($slug, $_locale, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //Get servicio
        $servicio = $em->getRepository('PortadaBundle:Servicio')->findOneBy(array(
            'slug' => $slug,
            'locale' => $_locale
        ));
        //404
        if (!$servicio) {
            throw new NotFoundHttpException();
        }

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
                    //new Response('success');
                } else {
                    //fail
                    $flashBag = $this->get('session')->getFlashBag();
                    $flashBag->add('info', $name.$translator->trans('portada.info_success'));
                    //new Response('info');
                }

            } else {
                $flashBag = $this->get('session')->getFlashBag();
                $flashBag->add('info', $name.$translator->trans('portada.info_success'));
                //new Response('info');
            }
        }

        // echo "<pre>";
        // \Doctrine\Common\Util\Debug::dump($servicio);
        // echo '</pre>';

    	return $this->render('PortadaBundle:Servicios:servicio.html.twig', array(
        	'form'=>$form->createView(),
            'servicio' => $servicio
        ));
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

    public function dashboardAction()
    {
        return $this->render('PortadaBundle:Default:dashboard.html.twig');
    }

    public function wellkonwn01Action()
    {
        return $this->render('PortadaBundle:Default:wellkonwn01.html.twig');
    }

    public function wellkonwn02Action()
    {
        return $this->render('PortadaBundle:Default:wellkonwn02.html.twig');
    }
}
