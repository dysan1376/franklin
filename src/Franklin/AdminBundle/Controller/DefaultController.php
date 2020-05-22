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

    public function reviewsAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $reviews = $em->getRepository('PortadaBundle:Review')->findAllDesc();

        $adapter = new ArrayAdapter($reviews);
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(4);
        $pager->setCurrentPage($page);

        return $this->render('AdminBundle:Default:reviews.html.twig', array(
            'reviews' => $pager->getCurrentPageResults(),
            'pager' => $pager,
        ));
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $review = new Review();
        $review->setFecha(new \Datetime());
        $form = $this->createForm(new ReviewType(), $review);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {

                //Upload Picture
                $filePicture = $review->getPicture();
                if ($filePicture) {
                    $fileNamePicture = $this->generateUniqueFileName().'.'.$filePicture->guessExtension();
                    $filePicture->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/reviews',
                        $fileNamePicture
                    );
                    $review->setPicture($fileNamePicture);
                    //    
                }

                $em->persist($review);
                $em->flush();
                return $this->redirect($this->generateUrl('admin_review'));
            }
        }

        // echo "<div>";
        // \Doctrine\Common\Util\Debug::dump($review->getComentario());
        // echo '</div>';

        return $this->render('AdminBundle:Review:new.html.twig', array(
            'form' => $form->createView()
        ));

    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        //Setters
        $review = $em->getRepository('PortadaBundle:Review')->find($id);

        $originalComentarios = array();
        // Create an array of the current Medicamentos objects in the database
        foreach ($review->getComentario() as $com) {
            $originalComentarios[] = $com;
        }


        //Last images
        $lastPicture = $review->getPicture();

        //Set files
        if ($lastPicture) {
            $review->setPicture(new File($this->get('kernel')->getRootDir().'/../web/uploads/reviews'.'/'.$lastPicture));
        }

        $form = $this->createForm(new ReviewType(), $review);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {

                //Edit Comentarios
                foreach ($review->getComentario() as $com) {
                    foreach ($originalComentarios as $key => $toDel) {
                        if ($toDel->getId() === $com->getId()) {
                            unset($originalComentarios[$key]);
                        }
                    }
                }
                
                // remove the relationship between the tag and the Task
                foreach ($originalComentarios as $com) {
                    // remove the Task from the Tag
                    $com->getReview()->removeComentario($review);

                    // if it were a ManyToOne relationship, remove the relationship like this
                    // $tag->setTask(null);

                    $em->persist($com);

                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($com);
                }

                //Edit picture
                $filePicture = $review->getPicture();
                if (!$filePicture) {
                    $review->setPicture($lastPicture);
                } else {
                    if ($lastPicture) {
                        //Remove Images
                        $review->removeFiles($lastPicture);    
                    }
                    //Upload Picture
                    $fileNamePicture = $this->generateUniqueFileName().'.'.$filePicture->guessExtension();
                    $filePicture->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/reviews',
                        $fileNamePicture
                    );
                    $review->setPicture($fileNamePicture);
                    //
                }

                $em->persist($review);
                $em->flush();
                return $this->redirect($this->generateUrl('admin_review'));
            }
        }

        //Set file name again
        $review->setPicture($lastPicture);
        return $this->render('AdminBundle:Review:edit.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
            'review' => $review
        ));
    }

    public function testAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $numberOfLastPosts = 6;
        $blogs = $em->getRepository('BlogBundle:Blog')->findLastMonthBlogs($numberOfLastPosts);

        $subject = "Newsletter test";
        $to = "dysan1376@gmail.com";

        //Send test email
        $this->get('franklin.mailer')->sendNewsletter($subject, $to, $numberOfLastPosts);
        
        return $this->render('AdminBundle:Default:mails.html.twig', array(
            'blogs' => $blogs
        ));
    }

    public function mailsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $numberOfLastPosts = 6;
        $blogs = $em->getRepository('BlogBundle:Blog')->findLastMonthBlogs($numberOfLastPosts);

        return $this->render('AdminBundle:Default:mails.html.twig', array(
            'blogs' => $blogs
        ));
    }

    public function newsletterAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $numberOfLastPosts = 6;
        $blogs = $em->getRepository('BlogBundle:Blog')->findLastMonthBlogs($numberOfLastPosts);

        return $this->render('AdminBundle:Mailer:newsletter.html.twig', array(
            'blogs' => $blogs
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
