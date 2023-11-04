<?php

namespace Franklin\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class NewsletterController extends Controller
{
	public function prepareAction(Request $request, $numberOfLastPosts)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();
        $blogs = $em->getRepository('BlogBundle:Blog')->findLastMonthBlogsPorLocale($numberOfLastPosts, $locale);

        return $this->render('AdminBundle:Mailer:prepareNewsletter.html.twig', array(
            'blogs' => $blogs
        ));
    }

    public function testAction(Request $request, $numberOfLastPosts, $email, $subject)
    {
        //Get locale
        $locale = $request->getLocale();
        //$locale = "es";
        // echo "<div>";
        // \Doctrine\Common\Util\Debug::dump($locale);
        // echo '</div>';

        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('BlogBundle:Blog')->findLastMonthBlogsPorLocale($numberOfLastPosts, $locale);
        // $blogs = $em->getRepository('BlogBundle:Blog')->findLastMonthBlogs($numberOfLastPosts);
        echo "<div>";
        \Doctrine\Common\Util\Debug::dump(count($blogs));
        echo '</div>';
        

        //Send test email
        if ($email) {
        	// $this->get('franklin.mailer')->sendNewsletter($subject, $email, $numberOfLastPosts);
        	// $flashBag = $this->get('session')->getFlashBag();
        	// $flashBag->add('primary', 'Se ha enviado el correo al destinatario: '.$email);	
        } else {
        	// $flashBag = $this->get('session')->getFlashBag();
        	// $flashBag->add('danger', 'No pudo enviarse el correo al destinatario: '.$email);
        }
        

        return $this->render('AdminBundle:Mailer:prepareNewsletter.html.twig', array(
            'blogs' => $blogs
        ));
    }

    public function sendAction(Request $request, $numberOfLastPosts, $subject)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();
        $blogs = $em->getRepository('BlogBundle:Blog')->findLastMonthBlogsPorLocale($numberOfLastPosts, $locale);

        $pacientes = $em->getRepository('UsuariosBundle:Paciente')->findNewsletterActive();

        foreach ($pacientes as $paciente) {
        	$email = $paciente->getEmail();
        	$isSubscribed = $paciente->getIsSubscribed();
        	if (($email) && ($isSubscribed)) {
        		//Send email
        		$this->get('franklin.mailer')->sendNewsletter($subject, $email, $numberOfLastPosts);
        	}
        }

        // echo "<div>";
        // \Doctrine\Common\Util\Debug::dump($pacientes);
        // echo '</div>';

		$flashBag = $this->get('session')->getFlashBag();
        $flashBag->add('primary', 'Se ha enviado el correo a todos los destinatarios');

        return $this->render('AdminBundle:Mailer:prepareNewsletter.html.twig', array(
            'blogs' => $blogs
        ));
    }

}