<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\service\CommentaireService;
use App\Repository\EvenementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement", name="evenement")
     */
    public function index(EvenementRepository $evenementRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $data = $evenementRepository->findBy([], ['id' => 'DESC']);

        $evenements = $paginator->paginate($data, $request->query->getInt('page', 1), 5);

        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }
/**
     * @Route("/evenement/{slug}", name="evenement-details", methods={"GET","POST"})
     */
    public function detail(Evenement $evenement, Request $request, CommentaireService $commentaireService, CommentaireRepository $commentaireRepository): Response
    {
        $commentaires = $commentaireRepository->findCommentaires($evenement);

        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire = $form->getData();
            $commentaireService->persistCommentaire($commentaire, $evenement, null);

            return $this->redirectToRoute('evenement-details', ['slug' => $evenement->getSlug()]);
        }

        return $this->render('evenement/details.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
            'commentaires' => $commentaires,
        ]);
    }
}
