<?php

namespace App\Controller;

use App\Repository\FriendsRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    #[Route('/users/list', name: 'users')]
    public function index(UsersRepository $usersRepository): Response
    {
		return $this->render(
			'users/list.html.twig',
			[
				'users' => $usersRepository->findAll(),
			]
		);
    }
}
