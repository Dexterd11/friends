<?php

namespace App\Controller;


use App\Repository\FriendsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FriendsController extends AbstractController
{
	/**
	 * @Route("/", name="index")
	 */
	public function indexAction(FriendsRepository $friendsRepository, Request $request): Response
	{
		$userA = $request->query->get('userA');
		$userB = $request->query->get('userB');

		return $this->render(
			'friends/index.html.twig',
			[
				'friends' => $friendsRepository->findLink($userA,$userB),
			]
		);
	}

}
