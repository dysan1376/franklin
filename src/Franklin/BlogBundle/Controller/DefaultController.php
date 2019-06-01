<?php

namespace Franklin\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\File;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

use Franklin\BlogBundle\Entity\Blog;

use Franklin\BlogBundle\Form\Type\BlogType;

class DefaultController extends Controller
{
    public function indexAction($page, $_locale)
    {
        $em = $this->getDoctrine()->getManager();
        $blogs = $em->getRepository('BlogBundle:Blog')->findBlogsPublicados();
        // $blogs = $em->getRepository('BlogBundle:Blog')->findBy(
        //     array(),
        //     array('id' => 'DESC')
        // );

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

        //Get blog in spanish
        if (!$blog) {
           
           $blog = $em->getRepository('BlogBundle:Blog')->findOneBy(array(
               'slug' => $slug,
               'locale' => 'es'
           )); 
        }
        
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

        // echo "<pre>";
        // \Doctrine\Common\Util\Debug::dump($this->get('kernel')->getRootDir().'/../web/uploads/posts/cover');
        // echo '</pre>';

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {

                //Upload cover
                $fileCover = $blog->getCover();
                if ($fileCover) {
                    $fileNameCover = $this->generateUniqueFileName().'.'.$fileCover->guessExtension();
                    $fileCover->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/posts/cover',
                        $fileNameCover
                    );
                    $blog->setCover($fileNameCover);
                    //    
                }
                
                //Upload background
                $fileBackground = $blog->getBackground();
                if ($fileBackground) {
                    $fileNameBackground = $this->generateUniqueFileName().'.'.$fileBackground->guessExtension();
                    $fileBackground->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/posts/background',
                        $fileNameBackground
                    );
                    $blog->setBackground($fileNameBackground);
                    //    
                }
                
                //Upload first
                $fileFirst = $blog->getFirst();
                if ($fileFirst) {
                    $fileNameFirst = $this->generateUniqueFileName().'.'.$fileFirst->guessExtension();
                    $fileFirst->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/posts/first',
                        $fileNameFirst
                    );
                    $blog->setFirst($fileNameFirst);
                    //    
                }

                //Upload second
                $fileSecond = $blog->getSecond();
                if ($fileSecond) {
                    $fileNameSecond = $this->generateUniqueFileName().'.'.$fileSecond->guessExtension();
                    $fileSecond->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/posts/second',
                        $fileNameSecond
                    );
                    $blog->setSecond($fileNameSecond);
                    //    
                }

                //Upload third
                $fileThird = $blog->getThird();
                if ($fileThird) {
                    $fileNameThird = $this->generateUniqueFileName().'.'.$fileThird->guessExtension();
                    $fileThird->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/posts/third',
                        $fileNameThird
                    );
                    $blog->setThird($fileNameThird);
                    //    
                }

                //Set No programado datetime
                $programar = $blog->getProgramar();
                if (!$programar) {
                    $fechaCreacion = $blog->getFechaCreacion();
                    $blog->setFechaProgramada($fechaCreacion);
                }


                $em->persist($blog);
                $em->flush();
                return $this->redirect($this->generateUrl('admin_blog'));
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
        //Last images
        $lastCover = $blog->getCover();
        $lastBackground = $blog->getBackground();
        $lastFirst = $blog->getFirst();
        $lastSecond = $blog->getSecond();
        $lastThird = $blog->getThird();

        

        //Set No programado datetime
        $programar = $blog->getProgramar();
        echo "<pre>";
        \Doctrine\Common\Util\Debug::dump('programar ' + $programar);
        echo '</pre>';
        echo "<pre>";
        \Doctrine\Common\Util\Debug::dump('Fecha Programada ' + $setFechaProgramada);
        echo '</pre>';
        if (!$programar) {
            $fechaCreacion = $blog->getFechaCreacion();
            $blog->setFechaProgramada($fechaCreacion);
        }

        $blog->setFechaActualizacion(new \Datetime());
        //Set files
        if ($lastCover) {
            $blog->setCover(new File($this->get('kernel')->getRootDir().'/../web/uploads/posts/cover'.'/'.$lastCover));    
        }
        if ($lastBackground) {
            $blog->setBackground(new File($this->get('kernel')->getRootDir().'/../web/uploads/posts/background'.'/'.$lastBackground));    
        }
        if ($lastFirst) {
            $blog->setFirst(new File($this->get('kernel')->getRootDir().'/../web/uploads/posts/first'.'/'.$lastFirst));    
        }
        if ($lastSecond) {
            $blog->setSecond(new File($this->get('kernel')->getRootDir().'/../web/uploads/posts/second'.'/'.$lastSecond));    
        }
        if ($lastThird) {
            $blog->setThird(new File($this->get('kernel')->getRootDir().'/../web/uploads/posts/third'.'/'.$lastThird));    
        }
        

        $form = $this->createForm(new BlogType(), $blog);
        


        if ($request->isMethod('POST')) {
            echo "<pre>";
            \Doctrine\Common\Util\Debug::dump('is post method');
            echo '</pre>';
            $form->bind($request);
            echo "<pre>";
            \Doctrine\Common\Util\Debug::dump('bind request');
            echo '</pre>';
            echo "<pre>";
            \Doctrine\Common\Util\Debug::dump($form->getErrorsAsString());
            echo '</pre>';
            if ($form->isValid()) {

                echo "<pre>";
                \Doctrine\Common\Util\Debug::dump('is Valid');
                echo '</pre>';

                $fileCover = $blog->getCover();
                if (!$fileCover) {
                    $blog->setCover($lastCover);
                } else {
                    if ($lastCover) {
                        //Remove Images
                        $blog->removeFiles('cover', $lastCover);    
                    }
                    //Upload cover
                    $fileNameCover = $this->generateUniqueFileName().'.'.$fileCover->guessExtension();
                    $fileCover->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/posts/cover',
                        $fileNameCover
                    );
                    $blog->setCover($fileNameCover);
                    //
                }

                $fileBackground = $blog->getBackground();
                if (!$fileBackground) {
                    $blog->setBackground($lastBackground);
                } else {
                    if ($lastBackground) {
                        //Remove Images
                        $blog->removeFiles('background', $lastBackground);    
                    }
                    //Upload background
                    $fileNameBackground = $this->generateUniqueFileName().'.'.$fileBackground->guessExtension();
                    $fileBackground->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/posts/background',
                        $fileNameBackground
                    );
                    $blog->setBackground($fileNameBackground);
                    //
                    echo "<pre>";
                    \Doctrine\Common\Util\Debug::dump('File name ' + $fileNameBackground);
                    echo '</pre>';
                }

                $fileFirst = $blog->getFirst();
                if (!$fileFirst) {
                    $blog->setFirst($lastFirst);
                } else {
                    if ($lastFirst) {
                        //Remove Images
                        $blog->removeFiles('first', $lastFirst);    
                    }
                    //Upload first
                    $fileNameFirst = $this->generateUniqueFileName().'.'.$fileFirst->guessExtension();
                    $fileFirst->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/posts/first',
                        $fileNameFirst
                    );
                    $blog->setFirst($fileNameFirst);
                    //
                }

                $fileSecond = $blog->getSecond();
                if (!$fileSecond) {
                    $blog->setSecond($lastSecond);
                } else {
                    if ($lastSecond) {
                        //Remove Images
                        $blog->removeFiles('second', $lastSecond);    
                    }
                    //Upload second
                    $fileNameSecond = $this->generateUniqueFileName().'.'.$fileSecond->guessExtension();
                    $fileSecond->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/posts/second',
                        $fileNameSecond
                    );
                    $blog->setSecond($fileNameSecond);
                    //
                }

                $fileThird = $blog->getThird();
                if (!$fileThird) {
                    $blog->setThird($lastThird);
                } else {
                    if ($lastThird) {
                        //Remove Images
                        $blog->removeFiles('third', $lastThird);    
                    }
                    //Upload third
                    $fileNameThird = $this->generateUniqueFileName().'.'.$fileThird->guessExtension();
                    $fileThird->move(
                        $this->get('kernel')->getRootDir().'/../web/uploads/posts/third',
                        $fileNameThird
                    );
                    $blog->setThird($fileNameThird);
                    //

                }

                $em->persist($blog);
                $em->flush();
                echo "<pre>";
                \Doctrine\Common\Util\Debug::dump('File flushed ');
                echo '</pre>';

                return $this->redirect($this->generateUrl('admin_blog'));
            }
        }
        echo "<pre>";
        \Doctrine\Common\Util\Debug::dump('Antes de set file name');
        echo '</pre>';

        //Set file name again
        $blog->setCover($lastCover);
        $blog->setBackground($lastBackground);
        $blog->setFirst($lastFirst);
        $blog->setSecond($lastSecond);
        $blog->setThird($lastThird);
        echo "<pre>";
        \Doctrine\Common\Util\Debug::dump('Antes de render twig');
        echo '</pre>';
    	return $this->render('BlogBundle:Default:blogedit.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
            'blog' => $blog
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
