<?php


namespace Franklin\AdminBundle\Mailer;

use Doctrine\ORM\EntityManager;

/**
 * @author Franklin Alvear
 */
class Mailer
{
	private $mailerService;
	private $templating;
	protected $em;

    public function __construct(\Swift_Mailer $mailerService, \Twig_Environment $templating, EntityManager $em)
    {
        $this->mailerService = $mailerService;
        $this->templating = $templating;
        $this->em = $em;
    }

    public function findLastMonthBlogs($numberOfLastPosts)
    {

    	$results = $this->em->getRepository('BlogBundle:Blog')->findLastMonthBlogs($numberOfLastPosts);

    	return $results;

    }

    public function sendNewsletter($subject, $to, $numberOfLastPosts)
    {

        $blogs = $this->findLastMonthBlogs($numberOfLastPosts);
	    
        if ($blogs) {
        	$message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('franklin@hospi.me')
            ->setTo($to)
            ->setBody(
                $this->templating->render(
                    'AdminBundle:Mailer:newsletter.html.twig', array(
                        'blogs' => $blogs,
                    )
                ),
                'text/html'
            );
	        $this->mailerService->send($message);
        }
    }
}