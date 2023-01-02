<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ArticleController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ArticleRepository $articleRepository,
    ) {
    }

    #[Route("/articles", name: 'articles_app', methods: ['GET'])]
    public function index()
    {
        $articles = $this->articleRepository->findAll();

        return $this->render('pages/articles.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route("/article/{id}", name: 'article_by_id', methods: ['GET'])]
    public function articleById(int $id)
    {
        $article = $this->articleRepository->find($id);
        
        return $this->render('article/article.html.twig',[
            'article' => $article,
        ]);
    }

    #[Route('/article/create', name: 'create_article', methods: ['GET','POST']), IsGranted('ROLE_USER')]
    public function create(Request $request): Response
    {

        $article = new Article();
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            $this->entityManager->persist($article);
            $this->entityManager->flush();

            return $this->redirectToRoute('home_app');
        }
        
        return $this->render('article/create.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }
}
