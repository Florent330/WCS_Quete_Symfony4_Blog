<?php


namespace App\Controller;


use App\Entity\Category;
use App\Form\ArticleSearchType;
use App\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/category", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     * @param Request $request
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function addCategory (Request $request): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            //return $this->RedirectToRoute('/Blog/show_category.html.twig');
            return $this->render('/Blog/show_category.html.twig' , ['form' => $form->createView()]);

        }
            return $this->render('/Blog/add_category.html.twig' , ['form' => $form->createView()]);
        }


    /**
     * @Route("/", name="index")
     * @param Request $request
     * @return Response
     */

    public function index ( Request $request ): Response
    {
        //....
        $form = $this->createForm(ArticleSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            // $data contient les données du $_POST
            // Faire une recherche dans la BDD avec les infos de $data...
        }
        return $this->render('Blog/form.html.twig', ['form' => $form->createView()]);
    }
}