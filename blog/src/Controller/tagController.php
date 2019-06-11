<?php


namespace App\Controller;

use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class tagController extends AbstractController
{
    /**
     * @Route("/tag/{name}", name="tag_article")
     * @return Response A response instance
     */
    public function show(Tag $tag): Response
    {
        $articles = $tag->getArticles();

        return $this->render('tag.html.twig',
        [
            'articles' => $articles,
            'tag' => $tag

        ]);
    }
}