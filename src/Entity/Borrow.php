<?php

namespace App\Entity;

use App\Repository\BorrowRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorrowRepository::class)]
class Borrow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'loan')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $book = null;

    #[ORM\ManyToOne(inversedBy: 'scrounge')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $borrowDate = null;

    #[ORM\ManyToOne(inversedBy: 'borrows')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $borrow = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): static
    {
        $this->book = $book;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getBorrowDate(): ?\DateTimeInterface
    {
        return $this->borrowDate;
    }

    public function setBorrowDate(\DateTimeInterface $borrowDate): static
    {
        $this->borrowDate = $borrowDate;

        return $this;
    }

    public function getBorrow(): ?Book
    {
        return $this->borrow;
    }

    public function setBorrow(?Book $borrow): static
    {
        $this->borrow = $borrow;

        return $this;
    }
}
