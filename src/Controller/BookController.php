<?php

namespace App\Controller;

use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]  
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/book/new', name: 'app_book_new')]
    public function new(Request $request, BookRepository $bookRepository){
        
        $form = $this->createForm(BookType::class);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()){
            $book = $form->getData();
            $bookRepository->save($book, true);

            return $this->redirectToRoute('app_authors');
        }
        
        return $this->render('book/new.html.twig', [
            'form' => $form,
        ]);
    }
}
