<?php

namespace Franklin\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\File;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

use Franklin\PortadaBundle\Entity\Caso;

use Franklin\PortadaBundle\Form\Type\CasoType;


class CasosController extends Controller
{
	public function casosAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $casos = $em->getRepository('PortadaBundle:Caso')->findAllDesc();

        $adapter = new ArrayAdapter($casos);
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(5);
        $pager->setCurrentPage($page);

        return $this->render('AdminBundle:Casos:casos.html.twig', array(
            'casos' => $pager->getCurrentPageResults(),
            'pager' => $pager,
        ));
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $caso = new Caso();
        $caso->setFecha(new \Datetime());
        $form = $this->createForm(new CasoType(), $caso);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {

                //Upload Picture
                $filePicture = $caso->getPicture();
                if ($filePicture) {
                    $fileNamePicture = $this->generateUniqueFileName().'.'.$filePicture->guessExtension();
                    $filePicture->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/casos/picture',
                        $fileNamePicture
                    );
                    $caso->setPicture($fileNamePicture);
                    //    
                }

                //Upload Hover
                $fileHover = $caso->getHover();
                if ($fileHover) {
                    $fileNameHover = $this->generateUniqueFileName().'.'.$fileHover->guessExtension();
                    $fileHover->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/casos/hover',
                        $fileNameHover
                    );
                    $caso->setHover($fileNameHover);
                    //    
                }

                $em->persist($caso);
                $em->flush();

                $flashBag = $this->get('session')->getFlashBag();
                $flashBag->add('primary', 'Se ha guardado exitosamente el caso de estudio');
                return $this->redirect($this->generateUrl('admin_casos'));
            }
        }

        // echo "<div>";
        // \Doctrine\Common\Util\Debug::dump($caso->getComentario());
        // echo '</div>';

        return $this->render('AdminBundle:Casos:new.html.twig', array(
            'form' => $form->createView()
        ));

    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        //Setters
        $caso = $em->getRepository('PortadaBundle:Caso')->find($id);

        $originalDescripciones = array();
        // Create an array of the current Medicamentos objects in the database
        foreach ($caso->getDescripcion() as $com) {
            $originalDescripcion[] = $com;
        }


        //Last Picture
        $lastPicture = $caso->getPicture();

        //Set Picture
        if ($lastPicture) {
            $caso->setPicture(new File($this->get('kernel')->getRootDir().'/../web/uploads/casos/picture'.'/'.$lastPicture));
        }

        //Last Hover
        $lastHover = $caso->getHover();

        //Set Hover
        if ($lastHover) {
            $caso->setHover(new File($this->get('kernel')->getRootDir().'/../web/uploads/casos/hover'.'/'.$lastHover));
        }

        $form = $this->createForm(new CasoType(), $caso);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {

                //Edit Comentarios
                foreach ($caso->getDescripcion() as $com) {
                    foreach ($originalDescripciones as $key => $toDel) {
                        if ($toDel->getId() === $com->getId()) {
                            unset($originalDescripciones[$key]);
                        }
                    }
                }
                
                // remove the relationship between the tag and the Task
                foreach ($originalDescripciones as $com) {
                    // remove the Task from the Tag
                    $com->getCaso()->removeDescripcion($caso);
                    // if it were a ManyToOne relationship, remove the relationship like this
                    // $tag->setTask(null);
                    $em->persist($com);
                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($com);
                }

                //Edit picture
                $filePicture = $caso->getPicture();
                if (!$filePicture) {
                    $caso->setPicture($lastPicture);
                } else {
                    if ($lastPicture) {
                        //Remove Images
                        $caso->removePicture($lastPicture);    
                    }
                    //Upload Picture
                    $fileNamePicture = $this->generateUniqueFileName().'.'.$filePicture->guessExtension();
                    $filePicture->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/casos/picture',
                        $fileNamePicture
                    );
                    $caso->setPicture($fileNamePicture);
                    //
                }

                //Edit hover
                $fileHover = $caso->getHover();
                if (!$fileHover) {
                    $caso->setHover($lastHover);
                } else {
                    if ($lastHover) {
                        //Remove Images
                        $caso->removeHover($lastHover);    
                    }
                    //Upload Picture
                    $fileNameHover = $this->generateUniqueFileName().'.'.$fileHover->guessExtension();
                    $fileHover->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/casos/hover',
                        $fileNameHover
                    );
                    $caso->setHover($fileNameHover);
                    //
                }

                $em->persist($caso);
                $em->flush();

                $flashBag = $this->get('session')->getFlashBag();
                $flashBag->add('primary', 'Se ha editado exitosamente el caso de estudio');
                return $this->redirect($this->generateUrl('admin_casos'));
            }
        }

        //Set file name again
        $caso->setPicture($lastPicture);
        $caso->setHover($lastHover);

        return $this->render('AdminBundle:Casos:edit.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
            'caso' => $caso
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