<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\Book1Type;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/book')]
final class BookController extends AbstractController
{
    #[Route(name: 'app_book_index', methods: ['GET'])]
    public function index(BookRepository $bookRepository): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('book/index.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_book_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $book = new Book();
        $form = $this->createForm(Book1Type::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($book);
            $entityManager->flush();

                    // Securisation de la page( seul l'admin peut avoir accès)



            return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
        }

        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Vous n’avez pas accès à cette page.');
        }


        return $this->render('book/new.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_book_show', methods: ['GET'])]
    public function show(Book $book): Response
    {

                // Securisation de la page( seul l'admin peut avoir accès)

                if (!$this->isGranted('ROLE_ADMIN')) {
                    throw $this->createAccessDeniedException('Vous n’avez pas accès à cette page.');
                }
        
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_book_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Book $book, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Book1Type::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

                    // Securisation de la page( seul l'admin peut avoir accès)



            return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
        }

        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Vous n’avez pas accès à cette page.');
        }


        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_book_delete', methods: ['POST'])]
    public function delete(Request $request, Book $book, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($book);
            $entityManager->flush();
        }

                // Securisation de la page( seul l'admin peut avoir accès)

                if (!$this->isGranted('ROLE_ADMIN')) {
                    throw $this->createAccessDeniedException('Vous n’avez pas accès à cette page.');
                }
        

        return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
    }
}
