<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
class Film
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     * @Assert\NotBlank
     */
    private $Number;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("post:read")
     * @Assert\NotBlank
     */
    private $Title;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("post:read")
     * @Assert\NotBlank
     */
    private $Actor;

    /**
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     */
    private $Year;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("post:read")
     */
    private $Prop;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("post:read")
     */
    private $Info;

    /**
     * @ORM\ManyToOne(targetEntity=Thema::class, inversedBy="films")
     * @Groups("post:read")
     */
    private $thema;

    /**
     * @ORM\ManyToMany(targetEntity=Actors::class, mappedBy="Film")
     * @Groups("post:read")
     */
    private $actors;

    /**
     * @ORM\ManyToMany(targetEntity=Acteur::class, mappedBy="films")
     * @Groups("post:read")
     */
    private $acteurs;


    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->acteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->Number;
    }

    public function setNumber(int $Number): self
    {
        $this->Number = $Number;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }


    public function getActor(): ?string
    {
        return $this->Actor;
    }

    public function setActor(?string $Actor): self
    {
        $this->Actor = $Actor;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->Year;
    }

    public function setYear(int $Year): self
    {
        $this->Year = $Year;

        return $this;
    }

    public function getProp(): ?string
    {
        return $this->Prop;
    }

    public function setProp(string $Prop): self
    {
        $this->Prop = $Prop;

        return $this;
    }


    public function getInfo(): ?string
    {
        return $this->Info;
    }

    public function setInfo(?string $Info): self
    {
        $this->Info = $Info;

        return $this;
    }

    public function getThema(): ?Thema
    {
        return $this->thema;
    }

    public function setThema(?Thema $thema): self
    {
        $this->thema = $thema;

        return $this;
    }

    /**
     * @return Collection|Actor[]
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actors $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
            $actor->addFilm($this);
        }

        return $this;
    }

    public function removeActor(Actors $actor): self
    {
        if ($this->actors->removeElement($actor)) {
            $actor->removeFilm($this);
        }

        return $this;
    }

    /**
     * @return Collection|Acteur[]
     */
    public function getActeurs(): Collection
    {
        return $this->acteurs;
    }

    public function addActeur(Acteur $acteur): self
    {
        if (!$this->acteurs->contains($acteur)) {
            $this->acteurs[] = $acteur;
            $acteur->addFilm($this);
        }

        return $this;
    }

    public function removeActeur(Acteur $acteur): self
    {
        if ($this->acteurs->removeElement($acteur)) {
            $acteur->removeFilm($this);
        }

        return $this;
    }

}
