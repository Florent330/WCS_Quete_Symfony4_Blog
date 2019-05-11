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
}