<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity=GovernanceUserInformation::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $governanceUserInformation;

    /**
     * @ORM\ManyToOne(targetEntity=Governance::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $governance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getGovernanceUserInformation(): ?GovernanceUserInformation
    {
        return $this->governanceUserInformation;
    }

    public function setGovernanceUserInformation(GovernanceUserInformation $governanceUserInformation): self
    {
        $this->governanceUserInformation = $governanceUserInformation;

        // set the owning side of the relation if necessary
        if ($governanceUserInformation->getUser() !== $this) {
            $governanceUserInformation->setUser($this);
        }

        return $this;
    }

    public function getGovernance(): ?Governance
    {
        return $this->governance;
    }

    public function setGovernance(?Governance $governance): self
    {
        $this->governance = $governance;

        return $this;
    }
}
