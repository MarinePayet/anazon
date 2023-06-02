<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <=7; $i++){
            $book= new Book();
            $book->setTitle('Harry Potter '.$i);
            $book->setDescription('<b>'.$i .'</b> <i>  bli bla blou </i>');
            $book->setAuthor($this->getReference(AuthorFixtures::AUTHOR_JK));
            $manager->persist($book);
        }

        for ($i=1; $i <=7; $i++){
            $book= new Book();
            $book->setTitle('Chroniques de Bridgerton '.$i);
            $book->setDescription('<b>'.$i .'</b> <i>Vie d\'une famille noble il y a fort longtemps </i>');
            $book->setAuthor($this->getReference(AuthorFixtures::AUTHOR_JQUINN));
            $manager->persist($book);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AuthorFixtures::class,
        ];  
    }


}
