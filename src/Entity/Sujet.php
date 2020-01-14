<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SujetRepository")
 */
class Sujet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user")
     */
    private $author;

    /**
     * @ORM\Column(type="date")
     */
    private $publicationDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\forum")
     */
    private $forum;

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

    public function getAuthor(): ?user
    {
        return $this->author;
    }

    public function setAuthor(?user $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getForum(): ?forum
    {
        return $this->forum;
    }

    public function setForum(?forum $forum): self
    {
        $this->forum = $forum;

        return $this;
    }
}
