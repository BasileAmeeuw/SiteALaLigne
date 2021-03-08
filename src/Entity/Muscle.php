<?php

namespace App\Entity;

use App\Repository\MuscleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MuscleRepository::class)
 */
class Muscle
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
    private $nameOfMuscle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ExtraExpl;

    /**
     * @ORM\OneToMany(targetEntity=Activity::class, mappedBy="muscle", cascade={"persist", "remove"})
     */
    private $activities;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameOfMuscle(): ?string
    {
        return $this->nameOfMuscle;
    }

    public function setNameOfMuscle(string $nameOfMuscle): self
    {
        $this->nameOfMuscle = $nameOfMuscle;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getExtraExpl(): ?string
    {
        return $this->ExtraExpl;
    }

    public function setExtraExpl(?string $ExtraExpl): self
    {
        $this->ExtraExpl = $ExtraExpl;

        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->setMuscle($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getMuscle() === $this) {
                $activity->setMuscle(null);
            }
        }

        return $this;
    }
}
