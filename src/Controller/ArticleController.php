<?php

namespace App\Controller;

use App\DTO\ArticleCreateFromInput;
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

    #[Route("/article", name: 'articles', methods: ['GET'])]
    public function index()
    {
        $articles = $this->articleRepository->findAll();

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/article/create', name: 'app_article_form', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function addArticleForm()
    {
        $form = $this->createForm(ArticleFormType::class, new ArticleCreateFromInput());
        return $this->render('article/create.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }

    #[Route('/article/create', name: 'create_article', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function addArticle(Request $request): Response
    {
        $article = new Article();
        $article->setTitle($request->request->get('title'));
        $article->setAuthor($request->request->get('author'));
        $article->setContent($request->request->get('texto'));
        dump($article);die;
        // $article = new Article();
        // $form = $this->createForm(ArticleFormType::class, $article);
        // $form->handleRequest($request);

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        return $this->redirectToRoute('home_app');
    }

    #[Route("/article/{article}", name: 'article_by_id', methods: ['GET'])]
    public function articleById(Article $article)
    {
        $article = $this->articleRepository->find($article->getid());
        
        return $this->render('article/article.html.twig',[
            'article' => $article,
        ]);
    }
}
