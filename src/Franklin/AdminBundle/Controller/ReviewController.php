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

use Franklin\PortadaBundle\Form\Type\ReviewType;


class ReviewController extends Controller
{
	public function reviewsAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $reviews = $em->getRepository('PortadaBundle:Review')->findAllDesc();

        $adapter = new ArrayAdapter($reviews);
        $pager = new Pagerfanta($adapter);
        $pager->setMaxPerPage(4);
        $pager->setCurrentPage($page);

        return $this->render('AdminBundle:Review:reviews.html.twig', array(
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