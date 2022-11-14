<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="app_article")
     */
    public function index(): Response
    {
        $tabNumber = [3, 5, 6, 18, 19, 20];
        $fruit = ['pomme', 'poire' , 'kiwi'];
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
    public function afficher_article(int $numero): Response
    {

        return $this->render('article/article.html.twig', [
            'numArticle' => $numero
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
        } elseif ($action === "remove" ) {
            $retour = rand(11, 50);
        } else {
            // Renvoyer une erreur
        }
        return new JsonResponse([
            'vote' => $retour
        ]);

    }




}
