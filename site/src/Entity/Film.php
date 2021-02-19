<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
class Film
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $Theme;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Actor;

    /**
     * @ORM\Column(type="integer")
     */
    private $Year;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Prop;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Info;

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

    public function getTheme(): ?string
    {
        return $this->Theme;
    }

    public function setTheme(?string $Theme): self
    {
        $this->Theme = $Theme;

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
}
