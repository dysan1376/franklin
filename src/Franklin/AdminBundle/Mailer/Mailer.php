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

    public function findLastMonthBlogsPorLocale($numberOfLastPosts, $locale)
    {

    	$results = $this->em->getRepository('BlogBundle:Blog')->findLastMonthBlogsPorLocale($numberOfLastPosts, $locale);

    	return $results;

    }

    public function sendNewsletter($subject, $email, $numberOfLastPosts, $locale)
    {

        $blogs = $this->findLastMonthBlogsPorLocale($numberOfLastPosts, $locale);
	    
        if ($blogs) {
        	$message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('info@franklinalvear.com')
            ->setTo($email)
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