<?php

namespace App\Entity;

use App\Repository\StudentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StudentsRepository::class)]
class Students
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getDriver', 'getStudents'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['getDriver', 'getStudents'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 50)]
    #[Groups(['getDriver', 'getStudents'])]
    private ?string $lastname = null;

    #[ORM\Column(length: 100)]
    #[Groups(['getDriver', 'getStudents'])]
    private ?string $emailAddress = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['getDriver', 'getStudents'])]
    private string $phoneNumber;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateofBirth = null;

    #[ORM\ManyToOne(inversedBy: 'permitConduit')]
    private ?Driver $driver = null;

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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

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

    public function getDriver(): ?Driver
    {
        return $this->driver;
    }

    public function setDriver(?Driver $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    // public function setIsDrivingCar(?Driver $driver): self
    // {
    //     $this->driver = $driver;

    //     return $this;
    // }


    public function __toString(): string
    {
        return $this->firstname;
    }



}
