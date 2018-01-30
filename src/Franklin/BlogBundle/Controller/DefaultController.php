<?php

namespace Franklin\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Franklin\BlogBundle\Entity\Blog;

use Franklin\BlogBundle\Form\Type\BlogType;

class DefaultController extends Controller
{
    public function indexAction($_locale)
    {
        return $this->render('BlogBundle:Default:blogs.html.twig');
    }

    public function slugAction($_locale)
    {
    	return $this->render('BlogBundle:Default:blog.html.twig');
    }

    public function newAction($_locale, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $blog = new Blog();
        $blog->setFechaCreacion(new \Datetime());
        $form = $this->createForm(new BlogType(), $blog);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($blog);
                $em->flush();
                return $this->redirect($this->generateUrl('blog_homepage'));
            }
        }

    	return $this->render('BlogBundle:Default:blognew.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction($_locale, $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //Setters
        $blog = $em->getRepository('BlogBundle:Blog')->find($id);
        $blog->setFechaActualizacion(new \Datetime());

        $form = $this->createForm(new BlogType(), $blog);


        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {

                $em->persist($blog);
                $em->flush();

                return $this->redirect($this->generateUrl('blog_homepage'));
                
            }
        }
    	return $this->render('BlogBundle:Default:blogedit.html.twig', array(
            'form' => $form->createView(),
            'id' => $id
        ));
    }
}
