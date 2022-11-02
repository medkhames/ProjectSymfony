<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
{
    #[ORM\Id]
    #[ORM\Column]
    private $ref;

    #[ORM\Column(length: 255)]
    private  $CreationAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreationAt(): ?string
    {
        return $this->CreationAt;
    }

    public function setCreationAt(string $CreationAt): self
    {
        $this->CreationAt = $CreationAt;

        return $this;
    }
}
