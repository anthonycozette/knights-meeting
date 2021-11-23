<?php

namespace App\service;

use DateTime;
use App\Entity\Evenement;
use App\Entity\Commentaire;
use App\service\CommentaireService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class CommentaireService
{
    private $manager;
    private $flash;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flash)
    {
        $this->manager = $manager;
        $this->flash = $flash;
    }

    public function persistCommentaire(Commentaire $commentaire, Evenement $evenement = null): void
    {
        $commentaire->setIsPublished(true)
        ->setEvenement($evenement)
        ->setCreatedAt(new DateTime('now'));

        $this->manager->persist($commentaire);
        $this->manager->flush();
        $this->flash->add('success', 'Votre commentaire est bien envoyé.');
    }
}
