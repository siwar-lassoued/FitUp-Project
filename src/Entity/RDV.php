<?php

namespace App\Entity;

use App\Repository\RDVRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RDVRepository::class)]
class RDV
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /**
     * @var User The user associated with the RDV
     */
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'rDVs')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    /**
     * @var Collection<int, Coach>
     */
    #[ORM\OneToMany(targetEntity: Coach::class, mappedBy: 'rDVs')]
    private Collection $coach;

    public function __construct()
    {
        $this->coach = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Coach>
     */
    public function getCoach(): Collection
    {
        return $this->coach;
    }

    public function addCoach(Coach $coach): static
    {
        if (!$this->coach->contains($coach)) {
            $this->coach->add($coach);
            $coach->setRDV($this);
        }

        return $this;
    }

    public function removeCoach(Coach $coach): static
    {
        if ($this->coach->removeElement($coach)) {
            if ($coach->getRDV() === $this) {
                $coach->setRDV(null);
            }
        }

        return $this;
    }
}
