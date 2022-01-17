<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UsersFixture extends Fixture
{
	private $faker;

	public function __construct()
	{
		$this->faker = Factory::create();
	}
	public function load(ObjectManager $manager): void
	{
		for ($i = 0; $i < 100; $i++) {
			$manager->persist($this->getUser());
		}
		$manager->flush();
	}

	private function getUser()
	{
		return new Users(
			$this->faker->name(),
			rand(1,10000)
		);
	}
}
