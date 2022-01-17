<?php

namespace App\Entity;

use App\Repository\FriendsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendsRepository::class)]
class Friends
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	private $id;

	#[ORM\Column(type: 'bigint', nullable: true)]
	private $user_id;

	#[ORM\Column(type: 'bigint', nullable: true)]
	private $friend_id;

	#[ORM\Column(type: 'string', length: 255, nullable: true)]
	private $friend_name;

	public function __construct($user_id, $friend_id, $friend_name)
	{
		$this->user_id = $user_id;
		$this->friend_id = $friend_id;
		$this->friend_name = $friend_name;
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getUserId(): ?string
	{
		return $this->user_id;
	}

	public function setUserId(?string $user_id): self
	{
		$this->user_id = $user_id;

		return $this;
	}

	public function getFriendId(): ?string
	{
		return $this->friend_id;
	}

	public function setFriendId(?string $friend_id): self
	{
		$this->friend_id = $friend_id;

		return $this;
	}

	public function getFriendName(): ?string
	{
		return $this->friend_name;
	}

	public function setFriendName(?string $friend_name): self
	{
		$this->friend_name = $friend_name;

		return $this;
	}
}
