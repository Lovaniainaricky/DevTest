<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class TabController extends AbstractController
{
    /**
     * @Route("/tab", name="app_tab")
     */
    public function index(): Response
    {
        
        // Récupérer les données de l'API
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'https://jsonplaceholder.typicode.com/comments');
        $data = $response->toArray();

        // Trier les données par "postId" puis par "id"
        usort($data, function ($a, $b) {
            return [$a['postId'], $a['id']] <=> [$b['postId'], $b['id']];
        });

        // echo "<pre>";var_dump($data);echo "</pre>";die;

        return $this->render('tableau.html.twig', [
            'data' => $data,
        ]);
    }
}
