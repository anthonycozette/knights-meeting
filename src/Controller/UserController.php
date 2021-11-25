<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    #[Route('/user/pass/modifier', name: 'user_pass_modifier')]
    public function editPass(Request $request, UserPasswordHasherInterface $PasswordEncoder)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            // on verifie si les deux mot de passe sont identique
            if ($request->request->get('pass') == $request->request->get('pass2')) {
                $user->setPassword($PasswordEncoder->hashPassword($user, $request->request->get('pass')));
                $em->flush();
                
                $this->addFlash('message', 'Mot de passe mis a jour');

                return $this->redirectToRoute('user');
            } else {
                $this->addFlash('error', 'les deux mot de passe ne sont pas identiques');
            }
        }
        return $this->render('user/editPass.html.twig');
    }
}
