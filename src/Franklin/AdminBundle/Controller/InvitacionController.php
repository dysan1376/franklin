<?php

namespace Franklin\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\File;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

use Franklin\AdminBundle\Entity\Invitacion;

use Franklin\AdminBundle\Form\Type\InvitacionType;


class InvitacionController extends Controller
{

    public function invitacionesAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $invitaciones = $em->getRepository('AdminBundle:Invitacion')->findAllDesc();

        $adapter = new ArrayAdapter($invitaciones);
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(5);
        $pager->setCurrentPage($page);

        return $this->render('AdminBundle:Invitacion:invitaciones.html.twig', array(
            'invitaciones' => $pager->getCurrentPageResults(),
            'pager' => $pager,
        ));
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $invitacion = new Invitacion();
        $invitacion->setFecha(new \Datetime());
        $invitacion->setExpira(new \Datetime());

        $expira = $invitacion->getExpira();
        $expira->add(new \DateInterval('PT24H'));

        $form = $this->createForm(new InvitacionType(), $invitacion);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                echo "<div>";
                \Doctrine\Common\Util\Debug::dump($invitacion);
                echo '</div>';

                $em->persist($invitacion);
                echo "<div>";
                \Doctrine\Common\Util\Debug::dump('Paso persist');
                echo '</div>';
                $em->flush();
                echo "<div>";
                \Doctrine\Common\Util\Debug::dump('Paso flush');
                echo '</div>';

                $flashBag = $this->get('session')->getFlashBag();
                $flashBag->add('primary', 'Se ha creado exitosamente el enlace de la invitacion');
                return $this->redirect($this->generateUrl('admin_invitaciones'));
            }
        }

        // echo "<div>";
        // \Doctrine\Common\Util\Debug::dump($expira->format('Y-m-d H:i'));
        // echo '</div>';

        return $this->render('AdminBundle:Invitacion:new.html.twig', array(
            'form' => $form->createView()
        ));

    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        //Setters
        $invitacion = $em->getRepository('PortadaBundle:Invitacion')->find($id);

        $form = $this->createForm(new InvitacionType(), $invitacion);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {

                $em->persist($invitacion);
                $em->flush();

                $flashBag = $this->get('session')->getFlashBag();
                $flashBag->add('primary', 'Se ha editado exitosamente la invitación');
                return $this->redirect($this->generateUrl('admin_invitaciones'));
            }
        }

        return $this->render('AdminBundle:Invitacion:edit.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
            'invitacion' => $invitacion
        ));
    }

}