<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="category")
     */
    private $relatiob;

    public function __construct()
    {
        $this->relatiob = new ArrayCollection();
    }

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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getRelatiob(): Collection
    {
        return $this->relatiob;
    }

    public function addRelatiob(Article $relatiob): self
    {
        if (!$this->relatiob->contains($relatiob)) {
            $this->relatiob[] = $relatiob;
            $relatiob->setCategory($this);
        }

        return $this;
    }

    public function removeRelatiob(Article $relatiob): self
    {
        if ($this->relatiob->removeElement($relatiob)) {
            // set the owning side to null (unless already changed)
            if ($relatiob->getCategory() === $this) {
                $relatiob->setCategory(null);
            }
        }

        return $this;
    }
}
