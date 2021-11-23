<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'sitemap', defaults: ['_format' => 'xml'])]
    public function index(Request $request, EvenementRepository $evenementRepository): Response
    {
        $hostname = $request->getSchemeAndHttpHost();

        $urls = [];
        $urls[] = ['loc' => $this->generateUrl('home')];
        $urls[] = ['loc' => $this->generateUrl('evenement')];
        $urls[] = ['loc' => $this->generateUrl('presentation')];
        $urls[] = ['loc' => $this->generateUrl('contact')];

        foreach ($evenementRepository->findAll() as $evenement) {
            $urls[] = [
                'loc' => $this->generateUrl('evenement-details', ['slug' => $evenement->getSlug()]),
                'lastmod' => $evenement->getCreatedAt()->format('d-m-Y'),
            ];
        }

        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
                'urls' => $urls,
                'hostname' => $hostname,
            ]),
            200
        );

        $response->headers->set('Content-type', 'text/xml');

        return $response;
    }
}
