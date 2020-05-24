<?php

namespace Franklin\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\File;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

use Franklin\PortadaBundle\Entity\Review;
use Franklin\PortadaBundle\Entity\Comentario;

use Franklin\PortadaBundle\Form\Type\ReviewType;
use Franklin\PortadaBundle\Form\Type\ComentarioType;


class DefaultController extends Controller
{
    public function dashboardAction()
    {
        $em = $this->getDoctrine()->getManager();

        //Blog stats
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

        //Pacientes stats
        $desde = new \DateTime('2020-05-14');
        $desde->format('Y-m-d');
        $hasta = new \DateTime('tomorrow');
        $hasta->format('Y-m-d');
        $interval = new \DateInterval('P1D');
        $period = new \DatePeriod($desde, $interval, $hasta);

        $pacientes = [];
        foreach ($period as $key => $value) {
            $ini = $value->format('Y-m-d');
            $iniFormat = new \DateTime($value->format('Y-m-d'));
            $end = $iniFormat->add(new \DateInterval("P1D"));
            $subscribed = $em->getRepository('UsuariosBundle:Paciente')->pacientesPeriodoIsSubscribed($ini, $end, 1);
            $unSubscribed = $em->getRepository('UsuariosBundle:Paciente')->pacientesPeriodoIsSubscribed($ini, $end, 0);
            $label = new \DateTime($ini);
            $pacientes[] = [$key, count($subscribed), count($unSubscribed), $label->format('D')];//$end->format('Y-m-d');
        }

        // echo "<pre>";
        // \Doctrine\Common\Util\Debug::dump($pacientes);
        // echo '</pre>';


    	return $this->render('AdminBundle:Default:dashboard.html.twig', array(
            'blogs' => count($blogs),
            'plastica' => $plastica,
            'informacion' => $informacion,
            'tendencias' => $tendencias,
            'otros' => $otros,
            'days' => $days,
            'pacientes' => $pacientes
        ));
    }

    public function profileAction()
    {
    	return $this->render('AdminBundle:Default:profile.html.twig');
    }

    public function blogAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('BlogBundle:Blog')->findAllDesc();
        // $blogs = $em->getRepository('BlogBundle:Blog')->findBy(
        //     array(),
        //     array('id' => 'DESC')
        // );
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

    

    public function mailsAction(Request $request, $page)
    {
        $em = $this->getDoctrine()->getManager();
        //TODO
        $pacientes = $em->getRepository('UsuariosBundle:Paciente')->findAllDesc();

        $adapter = new ArrayAdapter($pacientes);
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(5);
        $pager->setCurrentPage($page);

        return $this->render('AdminBundle:Default:mails.html.twig', array(
            'pacientes' => $pager->getCurrentPageResults(),
            'pager' => $pager,
        ));
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

}
