<?php

namespace App\Entity;

use App\Repository\GuestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuestRepository::class)]
class Guest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    // Relation avec Event (plusieurs invités pour un événement)
    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: 'guests')]
    private $event;
   
    // Relation avec Invitation (chaque invité a une invitation)
    #[ORM\OneToOne(mappedBy: 'guest', cascade: ['persist', 'remove'])]
    private $invitation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }
    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getInvitation(): ?Invitation
    {
        return $this->invitation;
    }

    public function setInvitation(?Invitation $invitation): self
    {
        // lien bidirectionnel entre invitation et invité
        if ($invitation === null && $this->invitation !== null) {
            $this->invitation->setGuest(null);
        }

        if ($invitation !== null && $invitation->getGuest() !== $this) {
            $invitation->setGuest($this);
        }

        $this->invitation = $invitation;

        return $this;
    }
}
