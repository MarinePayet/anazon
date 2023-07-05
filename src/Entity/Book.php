<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;    
use ApiPlatform\Metadata as Api;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[Api\ApiResource( 
    normalizationContext: ['groups' => ["read_books"]],
    )]
class Book
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Your first name must be at least 2 characters long',
        maxMessage: 'Your first name cannot be longer than 255 characters',
    )]
    #[Groups(['read_books'])]
    private ?string $title = null;

    #[ORM\Column(length: 128, unique: true)]
    #[Gedmo\Slug(fields: ['title'])]
    #[Groups(['read_books'])]
    private $slug;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Your first name must be at least 2 characters long',
        maxMessage: 'Your first name cannot be longer than 255 characters',
    )]
    #[Groups(['read_books'])]    
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Author $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}
