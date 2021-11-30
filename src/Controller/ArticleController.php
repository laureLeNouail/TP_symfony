<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article.index")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
       
        
        $articles = $articleRepository->findAll();




        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles'=> $articles,
        ]);
    }


    /**
     * @Route("/article/{id}", name="article.show")
     */

    public function show($id): Response{

        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        
        $article = $articleRepository->find($id);

        if (!$article)
            {
                throw $this->createNotFoundException('The article does not exist');
            }


        return $this->render('article/show.html.twig', [
            'controller_name' => 'ArticleController',
            'article'=> $article,
        ]);
    }
}
