<?php

namespace App\Controller;

use App\Form\AuthorType;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;
use SebastianBergmann\Template\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}


// #[Route('/register', name: 'app_register')]
// public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
// {
//     $user = new User();
//     $form = $this->createForm(RegistrationFormType::class, $user);
//     $form->handleRequest($request);

//     if ($form->isSubmitted() && $form->isValid()) {
//         /** @var string $plainPassword */
//         $plainPassword = $form->get('plainPassword')->getData();

//         // encode the plain password
//         $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));
//         $user->setRoles(["ROLE_ADMIN"]);
//         $entityManager->persist($user);
//         $entityManager->flush();

//         // do anything else you need here, like send an email

//     }

//     return $this->render('registration/register.html.twig', [
//         'registrationForm' => $form,
//     ]);
//     return $this->redirectToRoute('app_home');

// }



