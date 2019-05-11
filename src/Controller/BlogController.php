<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="Blog_index")
     */

    public function index()
    {
        return $this->render('Blog/index.html.twig', [
            'owner' => 'Thomas',
        ]);
    }

    /**
     * @Route("/blog/show/{slug<[a-z-0-9-]+>?article-sans-titre}", name="Blog_show")
     */

    public function show( $slug)
    {
        $slugArray = explode("-", $slug);
        $title = ucwords(implode(" ", $slugArray));
        return $this->render('Blog/show.html.twig', [
            'title' => $title,
        ]);
    }
}