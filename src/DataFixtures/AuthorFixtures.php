<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{

    public const AUTHOR_JK = 'AUTHOR_JK';
    public const AUTHOR_JQUINN = 'AUTHOR_JQUINN';


    public function load(ObjectManager $manager): void
    {
        $author = new Author;
        $author->setName('JK Rowling');
        $manager->persist($author);
        $this->addReference(self::AUTHOR_JK, $author);

        $author = new Author;
        $author->setName('Julia Quinn');
        $manager->persist($author); 
        $this->addReference(self::AUTHOR_JQUINN, $author);


        $manager->flush();
    }



}
