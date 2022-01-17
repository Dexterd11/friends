<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	private $id;

	#[ORM\Column(type: 'string', length: 255)]
	private $name;

	#[ORM\Column(type: 'bigint')]
	private $user_id;

	public function __construct($name, $user_id)
	{
		$this->name = $name;
		$this->user_id = $user_id;
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

	public function getUserId(): ?string
	{
		return $this->user_id;
	}

	public function setUserId(string $user_id): self
	{
		$this->user_id = $user_id;

		return $this;
	}
}
