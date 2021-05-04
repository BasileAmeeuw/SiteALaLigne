<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=App\Repository\DayRepository::class)
 */
class Day
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["getActivityApi","getDayApi"])]
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     */
    #[Groups(["getActivityApi","getMuscleApi","getDayApi"])]
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Activity::class, inversedBy="days", cascade={"persist", "remove"})
     */
    #[Groups(["getDayApi"])]
    private $activity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }
}