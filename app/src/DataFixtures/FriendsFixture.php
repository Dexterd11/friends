<?php

namespace App\DataFixtures;

use App\Entity\Friends;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FriendsFixture extends Fixture implements DependentFixtureInterface
{

	private $faker;

	public function __construct()
	{

		$this->faker = Factory::create();
	}

	public function load(ObjectManager $manager)
	{
		$users = $manager->getRepository(Users::class)->findAll();
		foreach ($users as $user) {
			for ($i = 0; $i < 3; $i++) {
				$friend = $users[array_rand($users)];
				$manager->persist($this->getFriends($friend, $user));
				$manager->persist($this->getFriends($user, $friend));
			}
		}
		$manager->flush();
	}

	private function getFriends($user, $friend)
	{
		return new Friends(
			$user->getUserId(),
			$friend->getUserId(),
			$friend->getName(),
		);

	}


	public function getDependencies()
	{
		return [
			UsersFixture::class,
		];
	}
}
