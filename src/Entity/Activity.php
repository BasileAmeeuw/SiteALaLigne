<?php

namespace App\Entity;

use App\Entity\Muscle;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=App\Repository\ActivityRepository::class)
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(["getActivityApi","getMuscleApi","getDayApi"])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    #[Groups(["getActivityApi","getMuscleApi","getDayApi"])]
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    #[Groups(["getActivityApi","getMuscleApi","getDayApi"])]
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url
     */
    #[Groups(["getActivityApi","getMuscleApi","getDayApi"])]
    private $image;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     * @Assert\GreaterThanOrEqual(0)
     * @Assert\LessThanOrEqual(120)
     */
    #[Groups(["getActivityApi","getMuscleApi","getDayApi"])]
    private $duration;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     * @Assert\LessThanOrEqual(5)
     * @Assert\GreaterThanOrEqual(0)
     */
    #[Groups(["getActivityApi","getMuscleApi"])]
    private $difficult;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[Groups(["getActivityApi"])]
    private $author;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    #[Groups(["getActivityApi","getMuscleApi"])]
    private $material;

    /**
     * @ORM\Column(type="datetime")
     */
    #[Groups(["getActivityApi"])]
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    #[Groups(["getActivityApi"])]
    private $modifiedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Muscle::class, inversedBy="activities", cascade={"persist", "remove"})
     */
    #[Groups(["getActivityApi"])]
    private $muscle;

    /**
     * @ORM\OneToMany(targetEntity=Day::class, mappedBy="activity", cascade={"persist", "remove"})
     */
    #[Groups(["getActivityApi","getMuscleApi"])]
    private $days;


    public function __construct()
    {
        $this->days = new ArrayCollection();
    }

    public function setId(int $ID): self
    {
        $this->id = $ID;

        return $this;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDifficult(): ?int
    {
        return $this->difficult;
    }

    public function setDifficult(?int $difficult): self
    {
        $this->difficult = $difficult;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(?string $material): self
    {
        $this->material = $material;

        return $this;
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

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }


    public function getMuscle(): ?Muscle
    {
        return $this->muscle;
    }

    public function setMuscle(?Muscle $muscle): self
    {
        $this->muscle = $muscle;

        return $this;
    }

    /**
     * @return Collection|Day[]
     */
    public function getDays(): Collection
    {
        return $this->days;
    }

    public function addDay(Day $day): self
    {
        if (!$this->days->contains($day)) {
            $this->days[] = $day;
            $day->setActivity($this);
        }

        return $this;
    }

    public function removeDay(Day $day): self
    {
        if ($this->days->removeElement($day)) {
            // set the owning side to null (unless already changed)
            if ($day->getActivity() === $this) {
                $day->setActivity(null);
            }
        }

        return $this;
    }

}
