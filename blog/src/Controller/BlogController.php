<?php


namespace App\Controller;


use App\Form\ArticleSearchType;
use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    /**
     * Show my home page
     *
     * @Route("/", name="home")
     * @return Response A response instance
     */
    public function myHome(): Response
    {
        return $this->render(
            'blog.html.twig',
            []);
    }


    /**
     * Show all row from article's entity
     *
     * @Route("/blog/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        $form = $this->createForm(
            ArticleSearchType::class,
            null,
            ['method' => Request::METHOD_GET]
        );

        return $this->render(
            'blog/index.html.twig',
            [
                'articles' => $articles,
                'form' => $form->createView(),
            ]
        );
    }


    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     * @Route("/blog/show/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     * @return Response A response instance
     */
    public function show(?string $slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);


        return $this->render(
            'blog/article.html.twig',
            [
                'article' => $article,
                'slug' => $slug,
            ]
        );
    }

    /**
     * @Route("/blog/category/{name}",
     *     name="show_category")
     * ParamConverter("category", class="App\Entity\Category", options={"name" = "categoryName"})
     * @return Response
     */

    /*@param string $categoryName*/

    public function showByCategory(Category $category) : Response
    {
        if (!$category) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        /*$category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneby(['name' => $category]);*/

        $articles = $category->getArticles();
        $name = $category->getName();


        /*$articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['category' => $category], ['id' => 'DESC'], 3);*/


        return $this->render(
            'blog/category.html.twig',
            [
                'articles' => $articles,
                'name' => $name
            ]);
    }
}