<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DriverRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DriverRepository::class)]
class Driver
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getDriver'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getDriver', 'getStudents'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getDriver', 'getStudents'])]
    private ?string $emailAddress = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['getDriver', 'getStudents'])]
    private ?\DateTimeInterface $dateofBirth = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['getDriver', 'getStudents'])]
    private ?string $phoneNumber;

    #[ORM\Column(length: 30)]
    private ?string $carModel = null;
    #[Groups(['getDriver', 'getStudents'])]

    #[ORM\Column(length: 10)]
    #[Groups(['getDriver', 'getStudents'])]
    private ?string $plateNumber = null;

    #[ORM\Column]
    private ?bool $isDriving = null;
    #[Groups(['getDriver', 'getStudents'])]

    #[ORM\OneToMany(mappedBy: 'driver', targetEntity: Students::class)]
    private Collection $permitConduit;

    public function __construct()
    {
        $this->permitConduit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): self
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    public function getDateofBirth(): ?\DateTimeInterface
    {
        return $this->dateofBirth;
    }

    public function setDateofBirth(?\DateTimeInterface $dateofBirth): self
    {
        $this->dateofBirth = $dateofBirth;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCarModel(): ?string
    {
        return $this->carModel;
    }

    public function setCarModel(string $carModel): self
    {
        $this->carModel = $carModel;

        return $this;
    }

    public function getPlateNumber(): ?string
    {
        return $this->plateNumber;
    }

    public function setPlateNumber(string $plateNumber): self
    {
        $this->plateNumber = $plateNumber;

        return $this;
    }

    public function isIsDriving(): ?bool
    {
        return $this->isDriving;
    }

    public function setIsDriving(bool $isDriving): self
    {
        $this->isDriving = $isDriving;

        return $this;
    }

    /**
     * @return Collection<int, Students>
     */
    public function getPermitConduit(): Collection
    {
        return $this->permitConduit;
    }

    public function addPermitConduit(Students $permitConduit): self
    {
        if (!$this->permitConduit->contains($permitConduit)) {
            $this->permitConduit->add($permitConduit);
            $permitConduit->setDriver($this);
        }

        return $this;
    }

    public function removePermitConduit(Students $permitConduit): self
    {
        if ($this->permitConduit->removeElement($permitConduit)) {
            // set the owning side to null (unless already changed)
            if ($permitConduit->getDriver() === $this) {
                $permitConduit->setDriver(null);
            }
        }

        return $this;
    }

    





   
}
