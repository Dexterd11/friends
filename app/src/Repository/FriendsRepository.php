<?php

namespace App\Repository;

use App\Entity\Friends;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Friends|null find($id, $lockMode = null, $lockVersion = null)
 * @method Friends|null findOneBy(array $criteria, array $orderBy = null)
 * @method Friends[]    findAll()
 * @method Friends[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FriendsRepository extends ServiceEntityRepository
{
	private int $userA;
	private int $userB;

	public function __construct(ManagerRegistry $registry)
	{

		parent::__construct($registry, Friends::class);
	}

	/**
	 * @throws Exception
	 */
	public function findLink(int $userA, int $userB): ?array
	{
		$this->userA = $userA;
		$this->userB = $userB;
		return $this->getChain();

	}

	/**
	 * @throws Exception
	 */
	protected function getFriends($level): ?array
	{
		$qb = $this->createQueryBuilder('f0');
		switch ($level) {
			case 1:
				return $qb
					->select("f0.user_id as user_from,f0.friend_id as user_till")
					->where("f0.user_id = :userA")
					->andWhere("f0.friend_id = :userB")
					->setParameter("userA", $this->userA)
					->setParameter("userB", $this->userB)->setMaxResults(1)->getQuery()->getResult();
			case 2:
				return $qb
					->from("App\Entity\Friends", "f1")
					->select("f0.user_id as user_from,f1.user_id as chain_1,f1.friend_id as user_till")
					->where("f0.user_id = :userB")
					->andWhere("f0.friend_id = f1.user_id")
					->andWhere("f1.friend_id = :userA")
					->setParameter("userA", $this->userA)
					->setParameter("userB", $this->userB)->setMaxResults(1)->getQuery()->getResult();
			case 3:
				return $qb
					->from("App\Entity\Friends", "f1")
					->from("App\Entity\Friends", "f2")
					->select("f0.user_id as user_from,f1.user_id as chain_1,f2.user_id as chain_2,f2.friend_id as user_till")
					->where("f0.user_id = :userB")
					->andWhere("f0.friend_id = f1.user_id")
					->andWhere("f1.friend_id = f2.user_id")
					->andWhere("f2.friend_id = :userA")
					->setParameter("userA", $this->userA)
					->setParameter("userB", $this->userB)->setMaxResults(1)->getQuery()->getResult();
			case 4:
				return $qb
					->from("App\Entity\Friends", "f1")
					->from("App\Entity\Friends", "f2")
					->from("App\Entity\Friends", "f3")
					->select("f0.user_id as user_from,f1.user_id as chain_1,f2.user_id as chain_2,f3.user_id as chain_3,f3.friend_id as user_till")
					->where("f0.user_id = :userB")
					->andWhere("f0.friend_id = f1.user_id")
					->andWhere("f1.friend_id = f2.user_id")
					->andWhere("f2.friend_id = f3.user_id")
					->andWhere("f3.friend_id = :userA")
					->setParameter("userA", $this->userA)
					->setParameter("userB", $this->userB)->setMaxResults(1)->getQuery()->getResult();
		}
		return null;
	}

	/**
	 * @throws Exception
	 */
	private function getChain(): ?array
	{

		for ($i = 1; $i < 5; $i++) {
			$friends = $this->getFriends($i);
			if (!empty($friends)) {
				return $friends;
			}
		}
		return null;
	}
}
