<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Form\EditProfileType;
use App\service\CommentaireService;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }

    /**
     * @Route("/user/profil/modifier", name="user_profil_modifier")
     */
    public function editProfile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'profile mis a jour');
            return $this->redirectToRoute('user');
        }
        return $this->render('user/editProfile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/pass/modifier", name="user_pass_modifier")
     */
    public function editPass(Request $request, UserPasswordHasherInterface $passwordHasher)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();

            $user->setPassword($passwordHasher->hashPassword($user, $request));
            $em->flush();
            $this->addFlash('message', 'Mot de passe mis à jour avec succès');
            // on verifie que les deux mot de passe sont identiques
            // if ($request->request->get('pass') == $request->request->get('pass2')) {
            //     $user->setPassword($passwordHasher->hashPassword($user, $request->get('pass')));
            //     $em->flush();
            //     $this->addFlash('message', 'Mot de passe mis à jour avec succès');

            return $this->redirectToRoute('user');
            // } else {
            //     $this->addFlash('error', 'Les deux mot de passe ne sont pas identiques');
            // }
        }
        return $this->render('user/editPass.html.twig');
    }

    /**
     * @Route("/user/{slug}", name="user-details", methods={"GET","POST"})
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

            return $this->redirectToRoute('user-details', ['slug' => $evenement->getSlug()]);
        }

        return $this->render('user/details.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
            'commentaires' => $commentaires,
        ]);
    }
}
