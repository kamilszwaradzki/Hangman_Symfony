<?php

namespace App\Entity;

use App\Repository\WordRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WordRepository::class)
 */
class Word
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $letters = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLetters(): ?array
    {
        return $this->letters;
    }

    public function setLetters(array $letters): self
    {
        $this->letters = $letters;

        return $this;
    }
}
