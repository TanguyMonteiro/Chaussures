<?php

namespace App\Entity;

use App\Repository\LacetRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LacetRepository::class)
 */
class Lacet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"lacetApi"})
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=Chaussure::class, inversedBy="lacets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chaussure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getChaussure(): ?chaussure
    {
        return $this->chaussure;
    }

    public function setChaussure(?chaussure $chaussure): self
    {
        $this->chaussure = $chaussure;

        return $this;
    }
}
