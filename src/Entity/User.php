<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

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
     * @ORM\Column(type="string", length=20)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profil;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $github;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $linkedin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Software::class, mappedBy="users")
     */
    private $softwares;

    /**
     * @ORM\ManyToMany(targetEntity=OperatingSystem::class, mappedBy="users")
     */
    private $operatingSystems;

    /**
     * @ORM\ManyToMany(targetEntity=Language::class, mappedBy="users")
     */
    private $languages;

    /**
     * @ORM\ManyToMany(targetEntity=Database::class, mappedBy="users")
     */
    private $databaseLanguages;

    /**
     * @ORM\ManyToMany(targetEntity=Framework::class, mappedBy="users")
     */
    private $frameworks;

    /**
     * @ORM\ManyToMany(targetEntity=Cms::class, mappedBy="users")
     */
    private $cms;

    /**
     * @ORM\ManyToMany(targetEntity=Versionning::class, mappedBy="users")
     */
    private $versionnings;

    /**
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="user")
     */
    private $projects;

    /**
     * @ORM\Column(type="date")
     */
    private $age;

    public function __construct()
    {
        $this->softwares = new ArrayCollection();
        $this->operatingSystems = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->databaseLanguages = new ArrayCollection();
        $this->frameworks = new ArrayCollection();
        $this->cms = new ArrayCollection();
        $this->versionnings = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->username;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(string $profil): self
    {
        $this->profil = $profil;

        return $this;
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

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(string $github): self
    {
        $this->github = $github;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }
    
    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

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

    /**
     * @return Collection<int, Software>
     */
    public function getSoftwares(): Collection
    {
        return $this->softwares;
    }

    public function addSoftware(Software $software): self
    {
        if (!$this->softwares->contains($software)) {
            $this->softwares[] = $software;
            $software->addUser($this);
        }

        return $this;
    }

    public function removeSoftware(Software $software): self
    {
        if ($this->softwares->removeElement($software)) {
            $software->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, OperatingSystem>
     */
    public function getOperatingSystems(): Collection
    {
        return $this->operatingSystems;
    }

    public function addOperatingSystem(OperatingSystem $operatingSystem): self
    {
        if (!$this->operatingSystems->contains($operatingSystem)) {
            $this->operatingSystems[] = $operatingSystem;
            $operatingSystem->addUser($this);
        }

        return $this;
    }

    public function removeOperatingSystem(OperatingSystem $operatingSystem): self
    {
        if ($this->operatingSystems->removeElement($operatingSystem)) {
            $operatingSystem->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Language>
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Language $language): self
    {
        if (!$this->languages->contains($language)) {
            $this->languages[] = $language;
            $language->addUser($this);
        }

        return $this;
    }

    public function removeLanguage(Language $language): self
    {
        if ($this->languages->removeElement($language)) {
            $language->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Database>
     */
    public function getDatabaseLanguages(): Collection
    {
        return $this->databaseLanguages;
    }

    public function addDatabaseLanguage(Database $databaseLanguage): self
    {
        if (!$this->databaseLanguages->contains($databaseLanguage)) {
            $this->databaseLanguages[] = $databaseLanguage;
            $databaseLanguage->addUser($this);
        }

        return $this;
    }

    public function removeDatabaseLanguage(Database $databaseLanguage): self
    {
        if ($this->databaseLanguages->removeElement($databaseLanguage)) {
            $databaseLanguage->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Framework>
     */
    public function getFrameworks(): Collection
    {
        return $this->frameworks;
    }

    public function addFramework(Framework $framework): self
    {
        if (!$this->frameworks->contains($framework)) {
            $this->frameworks[] = $framework;
            $framework->addUser($this);
        }

        return $this;
    }

    public function removeFramework(Framework $framework): self
    {
        if ($this->frameworks->removeElement($framework)) {
            $framework->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Cms>
     */
    public function getCms(): Collection
    {
        return $this->cms;
    }

    public function addCm(Cms $cm): self
    {
        if (!$this->cms->contains($cm)) {
            $this->cms[] = $cm;
            $cm->addUser($this);
        }

        return $this;
    }

    public function removeCm(Cms $cm): self
    {
        if ($this->cms->removeElement($cm)) {
            $cm->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Versionning>
     */
    public function getVersionnings(): Collection
    {
        return $this->versionnings;
    }

    public function addVersionning(Versionning $versionning): self
    {
        if (!$this->versionnings->contains($versionning)) {
            $this->versionnings[] = $versionning;
            $versionning->addUser($this);
        }

        return $this;
    }

    public function removeVersionning(Versionning $versionning): self
    {
        if ($this->versionnings->removeElement($versionning)) {
            $versionning->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setUser($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getUser() === $this) {
                $project->setUser(null);
            }
        }

        return $this;
    }

    public function getAge(): ?\DateTimeInterface
    {
        return $this->age;
    }

    public function setAge(\DateTimeInterface $age): self
    {
        $this->age = $age;

        return $this;
    }

}
