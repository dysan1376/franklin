<?php

namespace Franklin\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

use Franklin\BlogBundle\Entity\Blog;

use Franklin\BlogBundle\Form\Type\BlogType;

class DefaultController extends Controller
{
    public function indexAction($page, $_locale)
    {
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('BlogBundle:Blog')->findAll();

        $adapter = new ArrayAdapter($blogs);
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(6);
        $pager->setCurrentPage($page);

        return $this->render('BlogBundle:Default:blogs.html.twig', array(
            // 'blogs' => $blogs
            'blogs' => $pager->getCurrentPageResults(),
            'pager' => $pager,
        ));
    }

    public function viewAction($_locale, $slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //Get blog
        $blog = $em->getRepository('BlogBundle:Blog')->findOneBy(array(
            'slug' => $slug,
            'locale' => $_locale
        ));
        if (!$blog) {
            throw new NotFoundHttpException();
        }

    	return $this->render('BlogBundle:Default:blog.html.twig', array(
            'blog' => $blog
        ));

        //return $this->render('BlogBundle:Default:blog.html.twig');
    }

    public function newAction(Request $request)
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

    public function editAction($id, Request $request)
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
