<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gesdinet\JWTRefreshTokenBundle\Doctrine\RefreshTokenRepositoryInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

class User implements UserInterface, PasswordAuthenticatedUserInterface, RefreshTokenRepositoryInterface
{
    private $id;

    private string $identification;

    private string $name;

    private string $surname;

    private string $phone;

    private string $email;

    private string $password;

    private string $birthdate;

    private array $roles = [];

    public function getIdentification(): ?string
    {
        return $this->identification;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setIdentification(string $identification): self
    {
        $this->identification = $identification;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->identification;
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
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    /**
     * @param string $birthdate
     */
    public function setBirthdate(string $birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setHashedPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->identification;
    }
//
//    /**
//     * @param array $array
//     * @return mixed
//     */
//    public function convertArrayToObject(array $array): mixed
//    {
//        $user = new User();
//        $user->setId($array['id']);
//        $user->setIdentification($array['identification']);
//        $user->setName($array['name']);
//        $user->setSurname($array['surname']);
//        $user->setPhone($array['phone']);
//        $user->setEmail($array['email']);
//        $user->setBirthdate($array['birthdate']);
//        return $user;
//    }

    /**
     * @param $id
     * @return mixed|object|null
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }

    /**
     * @return array|object[]
     */
    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return array|object[]
     */
    public function findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null)
    {
        // TODO: Implement findBy() method.
    }

    /**
     * @param array $criteria
     * @return mixed|object|null
     */
    public function findOneBy(array $criteria)
    {
        // TODO: Implement findOneBy() method.
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        // TODO: Implement getClassName() method.
    }

    /**
     * @param $datetime
     * @return array
     */
    public function findInvalid($datetime = null)
    {
        // TODO: Implement findInvalid() method.
    }
}
