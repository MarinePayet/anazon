<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Form\BookChildType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AuthorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Author::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setColumns(6),
            AssociationField::new('books'),
            CollectionField::new('books')->setEntryType(BookChildType::class)->allowAdd(true)->allowDelete(true)
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add('name')

        ;
    }

    
} 
