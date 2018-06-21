<?php

namespace Franklin\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;



class DefaultController extends Controller
{
    public function dashboardAction()
    {
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('BlogBundle:Blog')->findAll();

        $plasticaArray = $em->getRepository('BlogBundle:Blog')->findBy(
            array('tag' => 'plástica')
        );
        $informacionArray = $em->getRepository('BlogBundle:Blog')->findBy(
            array('tag' => 'información')
        );
        $tendenciasArray = $em->getRepository('BlogBundle:Blog')->findBy(
            array('tag' => 'tendencias')
        );
        $otrosArray = $em->getRepository('BlogBundle:Blog')->findBy(
            array('tag' => 'otros')
        );

        //Last post date
        $lastPost = $em->getRepository('BlogBundle:Blog')->findBy(
            array(),
            array('id'=>'DESC'),1,0
        );
        $lastDate = $lastPost[0]->getFechaCreacion();
        $today = new \DateTime('now');
        $days = $lastDate->diff($today)->format('%a');


        //Numbers only
        $plastica = ((count($plasticaArray) * 100) / count($blogs));
        $plastica = round($plastica);

        $informacion = ((count($informacionArray) * 100) / count($blogs));
        $informacion = round($informacion);

        $tendencias = ((count($tendenciasArray) * 100) / count($blogs));
        $tendencias = round($tendencias);

        $otros = ((count($otrosArray) * 100) / count($blogs));
        $otros = round($otros);



    	return $this->render('AdminBundle:Default:dashboard.html.twig', array(
            'blogs' => count($blogs),
            'plastica' => $plastica,
            'informacion' => $informacion,
            'tendencias' => $tendencias,
            'otros' => $otros,
            'days' => $days
        ));
    }

    public function profileAction()
    {
    	return $this->render('AdminBundle:Default:profile.html.twig');
    }

    public function blogAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('BlogBundle:Blog')->findBy(
            array(),
            array('id' => 'DESC')
        );
        $adapter = new ArrayAdapter($blogs);
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(6);
        $pager->setCurrentPage($page);

        return $this->render('AdminBundle:Default:blogs.html.twig', array(
            // 'blogs' => $blogs
            'blogs' => $pager->getCurrentPageResults(),
            'pager' => $pager,
        ));
    }

}
