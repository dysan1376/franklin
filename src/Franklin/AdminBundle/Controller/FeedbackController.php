<?php

namespace Franklin\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\File;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

use Franklin\AdminBundle\Entity\Feedback;

use Franklin\AdminBundle\Form\Type\FeedbackType;


class FeedbackController extends Controller
{
	public function feedbackAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $feedbacks = $em->getRepository('AdminBundle:Feedback')->findAllDesc();

        $adapter = new ArrayAdapter($feedbacks);
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(5);
        $pager->setCurrentPage($page);

        return $this->render('AdminBundle:Feedback:feedback.html.twig', array(
            'feedbacks' => $pager->getCurrentPageResults(),
            'pager' => $pager,
        ));
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $feedback = new Feedback();
        $feedback->setFecha(new \Datetime());

        $form = $this->createForm(new FeedbackType(), $feedback);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {

                $em->persist($feedback);
                $em->flush();

                $flashBag = $this->get('session')->getFlashBag();
                $flashBag->add('primary', 'Se ha guardado exitosamente la calificación');
                return $this->redirect($this->generateUrl('admin_feedback'));
            }
        }

        // echo "<div>";
        // \Doctrine\Common\Util\Debug::dump($caso->getComentario());
        // echo '</div>';

        return $this->render('AdminBundle:Feedback:new.html.twig', array(
            'form' => $form->createView()
        ));

    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        //Setters
        $feedback = $em->getRepository('AdminBundle:Feedback')->find($id);

        $form = $this->createForm(new FeedbackType(), $feedback);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {

                $em->persist($feedback);
                $em->flush();

                $flashBag = $this->get('session')->getFlashBag();
                $flashBag->add('primary', 'Se ha editado exitosamente la calificación');
                return $this->redirect($this->generateUrl('admin_feedback'));
            }
        }

        return $this->render('AdminBundle:Feedback:edit.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
            'feedback' => $feedback
        ));
    }

    public function invitacionesAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $invitaciones = $em->getRepository('AdminBundle:Invitacion')->findAllDesc();

        $adapter = new ArrayAdapter($feedbacks);
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(5);
        $pager->setCurrentPage($page);

        return $this->render('AdminBundle:Feedback:invitaciones.html.twig', array(
            'invitaciones' => $pager->getCurrentPageResults(),
            'pager' => $pager,
        ));
    }

}