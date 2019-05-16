<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/",
     *     name="link_blog")
     */
    public function blog()
    {
        return $this->render('blog.html.twig');
    }

    /**
     * @Route("/blog/show/{slug}",
     *     requirements={"slug" = "[0-9a-z-]*"},
     *     name="link_article")
     */
    public function show($slug = 'no article found')
    {
        $slug = ucwords(str_replace("-", " ", $slug));
        return $this->render('show.html.twig',
            ['slug' => $slug]
        );
    }
}