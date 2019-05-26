<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RankingPagesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class RankingPages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SearchEngine")
     * @ORM\JoinColumn(nullable=false)
     */
    private $searchEngine;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Thematic")
     * @ORM\JoinColumn(nullable=false)
     */
    private $thematic;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_page;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="integer")
     */
    private $position_previous;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;
 
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberPage(): ?int
    {
        return $this->number_page;
    }

    public function setNumberPage(int $number_page): self
    {
        $this->number_page = $number_page;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getPositionPrevious(): ?int
    {
        return $this->position_previous;
    }

    public function setPositionPrevious(int $position_previous): self
    {
        $this->position_previous = $position_previous;

        return $this;
    }

    public function getSearchEngine(): ?SearchEngine
    {
        return $this->searchEngine;
    }

    public function setSearchEngine(?SearchEngine $searchEngine): self
    {
        $this->searchEngine = $searchEngine;

        return $this;
    }

    public function getThematic(): ?Thematic
    {
        return $this->thematic;
    }

    public function setThematic(?Thematic $thematic): self
    {
        $this->thematic = $thematic;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist() 
    {
        $this->createdAt = new \DateTime();
    }
      
    /**
     * @ORM\PreUpdate
     */
    public function preUpdate() 
    {
        $this->updatedAt = new \DateTime();
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
