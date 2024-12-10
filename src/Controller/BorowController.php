<?php

namespace App\Controller;

use App\Entity\Borrow;
use App\Form\BorrowType;
use App\Repository\BorrowRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/borow')]
final class BorowController extends AbstractController
{
    #[Route(name: 'app_borow_index', methods: ['GET'])]
    public function index(BorrowRepository $borrowRepository): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('borow/index.html.twig', [
            'borrows' => $borrowRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_borow_new', methods: ['GET', 'POST'])]
    public function new(BorrowRepository $borowRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $borrow = new Borrow();
        $form = $this->createForm(BorrowType::class, $borrow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $borrow->setStatus("en cours");

            // Paramettrage de location "en cours et deja loué"
            $borows = $borowRepository->findAll();

            foreach ($borows as $borow){
                if ($borrow->getBook()->getTitle() === $borow->getBook()->getTitle()) {
                    $this->addFlash("error", "Ce livre est deja loué.");
                    return $this->redirectToRoute("app_borow_new");
                }
            }

            $entityManager->persist($borrow);
            $entityManager->flush();

            return $this->redirectToRoute('app_borow_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('borow/new.html.twig', [
            'borrow' => $borrow,
            'form' => $form,
        ]);
    }

    #[Route('/admin/{id}', name: 'app_borow_show', methods: ['GET'])]
    public function show(Borrow $borrow): Response
    {
                // Securisation de la page( seul l'admin peut avoir accès)

                if (!$this->isGranted('ROLE_ADMIN')) {
                    throw $this->createAccessDeniedException('Vous n’avez pas accès à cette page.');
                }
        
        return $this->render('borow/show.html.twig', [
            'borrow' => $borrow,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_borow_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Borrow $borrow, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BorrowType::class, $borrow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_borow_index', [], Response::HTTP_SEE_OTHER);
        }

        // Securisation de la page( seul l'admin peut avoir accès)

        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Vous n’avez pas accès à cette page.');
        }

        return $this->render('borow/edit.html.twig', [
            'borrow' => $borrow,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_borow_delete', methods: ['POST'])]
    public function delete(Request $request, Borrow $borrow, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$borrow->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($borrow);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_borow_index', [], Response::HTTP_SEE_OTHER);
    }
}
