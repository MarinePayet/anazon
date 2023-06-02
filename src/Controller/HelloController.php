<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello/{name<[a-zA-Z]{3,10}>}', name: 'app_hello')]
    public function index(string $name = "marine"): Response
    {
        return $this->render('hello/index.html.twig', [
            'name' => $name,
            'products' => [
                [
                    'price'=> '130.4',
                    'title'=> 'Pdt 1'
                ], 
                [
                    'price'=> '1354578.54676',
                    'title'=> 'Pdt 2'
                ],
                [
                    'price'=> '5.76',
                    'title'=> 'Pdt 3'
                ],
            ],
            'number' => rand(0,100)
        ]);
    }
}
