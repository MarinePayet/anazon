<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorsController extends AbstractController
{
    #[Route('/authors', name: 'app_authors')]
    public function index(AuthorRepository $authorRepository ): Response
    {        
        return $this->render('authors/index.html.twig', [

            'authors' => $authorRepository->findAll(),

        ]);
    }

    #[Route('/authors/{id<\d+>}', name: 'app_author_show')]
    public function show(Author $author){

        return $this->render('authors/show.html.twig', [
            'author' => $author,
        ]);
    }



    


}
