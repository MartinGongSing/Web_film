<?php

namespace App\Entity;

use App\Repository\ActorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ActorsRepository::class)
 */
class Actors
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("post:read")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Film::class, inversedBy="actors")
     */
    private $Film;

    public function __construct()
    {
        $this->Film = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilm(): Collection
    {
        return $this->Film;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->Film->contains($film)) {
            $this->Film[] = $film;
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        $this->Film->removeElement($film);

        return $this;
    }
}
