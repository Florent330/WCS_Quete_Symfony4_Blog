<?php


namespace App\Controller;


use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/blog", name="blog_") */

class BlogController extends AbstractController
{
    /**
     * Show all row from article's entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */

    public function index (): Response
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)
            ->findAll();
        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }
        return $this->render('Blog/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="show")
     * @return Response A response instance
     */

    public function show ( ?string $slug ): Response
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

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with ' . $slug . ' title, found in article\'s table.'
            );
        }

        return $this->render(
            'Blog/show.html.twig',
            [
                'article' => $article,
                'slug' => $slug,
            ]
        );
    }

    /**
     * @Route("/category/{name}", name="show_category")
     ** @return Response A response instance
     **/

    public function showByCategory ( Category $category )
    {
       /* $objetCategory =  $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $category]);*/

        $articles = $category->getArticles();

        return $this->render(
            'Blog/index.html.twig',
            [
                'articles' => $articles,
            ]
        );


    }
/*
    public function showByCategory ( string $category )
    {
        $objetCategory =  $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $category]);

        $articles = $objetCategory->getArticles();

        foreach ($articles as $art){
            echo $art->getContent();
        }
        exit;

    }
*/



    /*
            $categoryName = $this->getDoctrine()
                ->getRepository(Category::class)
                ->findOneBy(['name' => $category]);

            $articles = $this->getDoctrine()
                ->getRepository((Article::class))
                ->findBy(['category' => $categoryName],['id'=> 'desc'], 3);
            return $this->render(
                'Blog/category.html.twig',
                [
                    'category' => $categoryName,
                    'articles' => $articles,
                ]
            );*/

    /*$categoryName = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findOneBy(['name' => $category]);
    $*/
}