<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Valid;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
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
        minMessage: 'Le nom doit être d\'au moins 2 caractères ',
        maxMessage: 'Le nom doit être de moins de 255 caractères',
    )]
    private ?string $name = null;

    #[ORM\Column(length: 128, unique: true)]
    #[Gedmo\Slug(fields: ['name'])]
    private $slug;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Book::class, orphanRemoval: true, cascade: ['persist'])]
    #[Assert\Valid()]
    #[Assert\Count(
        min: 1,
        minMessage: 'Vous devez ajouter au moins un livre',
    )]

    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setAuthor($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getAuthor() === $this) {
                $book->setAuthor(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

