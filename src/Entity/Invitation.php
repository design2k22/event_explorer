<?php

namespace App\Entity;

use App\Repository\InvitationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvitationRepository::class)]
class Invitation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $qrCodePath = null;

    #[ORM\Column]
    private ?bool $isValidated = null;

    // Relation avec Guest (chaque invitation correspond à un invité)
    #[ORM\OneToOne(inversedBy: 'invitation', cascade: ['persist', 'remove'])]
    private $guest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQrCodePath(): ?string
    {
        return $this->qrCodePath;
    }

    public function setQrCodePath(string $qrCodePath): static
    {
        $this->qrCodePath = $qrCodePath;

        return $this;
    }

    public function isValidated(): ?bool
    {
        return $this->isValidated;
    }

    public function setValidated(bool $isValidated): static
    {
        $this->isValidated = $isValidated;

        return $this;
    }

    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    public function setGuest(?Guest $guest): self
    {
        $this->guest = $guest;

        return $this;
    }
}
