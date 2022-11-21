<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/twig", name="app_article")
     */
    public function index(): Response
    {
        $tabNumber = [3, 5, 6, 18, 19, 20];
        $fruit = ['pomme', 'poire', 'kiwi'];
        $date = date('Y-m-d');  // date du jour


        return $this->render('article/index.html.twig', [
            'tabNumber' => $tabNumber,
            'fruits' => $fruit,
            'date_jour' => $date,

        ]);
    }

    /**
     * @Route("/article/{numero<\d+>?1}", name="afficher_article" )
     */
    public function afficher_article(int $numero, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($numero);
        if (is_null($article)) {
            $article = $articleRepository->find('1');
        }
        return $this->render('article/article.html.twig', [
            'article' => $article
        ]);

    }


    /**
     * @Route("/article/vote/{action}", name="vote" )
     * @param string $action
     * @return Response
     */
    public function enregistrementVotes(string $action): Response
    {
        if ($action === "add") {
            $retour = rand(0, 10);
        } elseif ($action === "remove") {
            $retour = rand(11, 50);
        } else {
            // Renvoyer une erreur
        }
        return new JsonResponse([
            'vote' => $retour
        ]);

    }

    /**
     * @Route("/article/new", name="newArticle")
     */
    public function newArticle(EntityManagerInterface $manager): Response
    {
        $article = new Article();
        $article->setTitre('Quatrième   Article');
        $article->setContenu("Contenu du Quatrième   article  ");
        $dateTime = new \DateTime("2021-5-27 15:28:00");
        $article->setDateCreation($dateTime);

        $manager->persist($article);
        $manager->flush();

        return new Response("OK");
    }

    /**
     * @Route("/blog", name="blog")
     * @return Response
     */
    public function blog(ArticleRepository $articleRepository): Response
    {
        $listArticle = $articleRepository->findAll();


        return $this->render('article/blog.html.twig', [
            'listeArticle' => $listArticle,

        ]);
    }
}
