<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Routing\Annotation\Route;

class AuthorsController extends AbstractController
{
    #[Route('/authors', name: 'app_authors')]
    public function index(AuthorRepository $authorRepository, PaginatorInterface $paginator, Request $request ): Response
    {        

        $pagination = $paginator->paginate(
            $authorRepository->createQueryBuilder('a'), 
            $request->query->getInt('page', 1), 
            2
        );

        return $this->render('authors/index.html.twig', [

            'authors' => $pagination,

        ]);
    }

    #[Route('/authors/{id<\d+>}', name: 'app_author_show')]
    public function show(Author $author){

        return $this->render('authors/show.html.twig', [
            'author' => $author,
        ]);
    }

    #[Route('/authors/new', name: 'app_author_new')]
    public function new(Request $request, AuthorRepository $authorRepository){
        
        
        $form = $this->createForm(AuthorType::class);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()){
            $author = $form->getData();
            $authorRepository->save($author, true);
            
            return $this->redirectToRoute('app_authors');
        }
        
        return $this->render('authors/new.html.twig', [
            'authors' => $authorRepository->findAll(),
            'form' => $form,
        ]);
    }

    #[Route('/authors/edit/{id<\d+>}', name: 'app_author_edit')]
    public function edit(Author $author, Request $request, AuthorRepository $authorRepository){
        
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()){
            $author = $form->getData();
            $authorRepository->save($author, true);

            return $this->redirectToRoute('app_authors');
        }
        
        return $this->render('authors/new.html.twig', [
            'author' => $author,
            'form' => $form,
        ]);
    }

    


}
