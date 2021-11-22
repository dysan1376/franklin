<?php

namespace Franklin\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\File;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

use Franklin\UsuariosBundle\Entity\Paciente;

use Franklin\UsuariosBundle\Form\Type\PacienteType;


class PacienteController extends Controller
{
	public function pacientesAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $pacientes = $em->getRepository('UsuariosBundle:Paciente')->findAllDesc();

        $adapter = new ArrayAdapter($pacientes);
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(5);
        $pager->setCurrentPage($page);

        return $this->render('AdminBundle:Paciente:pacientes.html.twig', array(
            'pacientes' => $pager->getCurrentPageResults(),
            'pager' => $pager,
        ));
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $paciente = new Paciente();
        $paciente->setFecha(new \Datetime());

        $form = $this->createForm(new PacienteType(), $paciente);

        if ($request->isMethod('POST')) {


            $form->bind($request);
            if ($form->isValid()) {

                //Get email from form data
                $email = $form->get('email')->getData();

                $em->persist($paciente);

                try {

                   $em->flush();
                   $flashBag = $this->get('session')->getFlashBag();
                   $flashBag->add('primary', 'Se ha registrado exitosamente el paciente');
                   return $this->redirect($this->generateUrl('admin_pacientes'));

                }
                catch (\Doctrine\DBAL\DBALException $e) {
                    if ($e->getPrevious() &&  0 === strpos($e->getPrevious()->getCode(), '23')) {
                        
                        //throw new YourCustomException();
                        $flashBag = $this->get('session')->getFlashBag();
                        $flashBag->add('danger', 'El correo electrónico "'.$email.'" ya existe.');
                        return $this->redirect($this->generateUrl('admin_pacientes'));
                    }
                }

                
            }
        }

        // echo "<div>";
        // \Doctrine\Common\Util\Debug::dump($caso->getComentario());
        // echo '</div>';

        return $this->render('AdminBundle:Paciente:new.html.twig', array(
            'form' => $form->createView()
        ));

    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        //Find registro
        $paciente = $em->getRepository('UsuariosBundle:Paciente')->find($id);

        $form = $this->createForm(new PacienteType(), $paciente);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {

                $em->persist($paciente);
                $em->flush();

                $flashBag = $this->get('session')->getFlashBag();
                $flashBag->add('primary', 'Se ha editado exitosamente la información del paciente');
                return $this->redirect($this->generateUrl('admin_pacientes'));
            }
        }

        return $this->render('AdminBundle:Paciente:edit.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
            'paciente' => $paciente
        ));
    }

}