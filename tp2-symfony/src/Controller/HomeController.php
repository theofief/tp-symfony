<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }

    #[Route('/hello/{name}', name: 'hello')]
    public function hello(string $name): Response
    {
        return $this->render('home/hello.html.twig', [
            'name' => ucfirst($name)
        ]);
    }

    #[Route('/random', name: 'random')]
    public function random(): Response
    {
        $quotes = [
            "L'argent fait le bonheur. by Théo Fief",
            "Le temps c'est de l'argent. by Théo Fief",
            "18 06, la fraude fiscale c'est notre spécialité. by Sébastien",
            "Toutes ses citations sont humoristiques bien entendu. by Théo Fief"
        ];

        $quote = $quotes[array_rand($quotes)];

        return $this->render('home/random.html.twig', [
            'quote' => $quote
        ]);
    }

    #[Route('/api/random', name: 'api_random')]
    public function apiRandom(): JsonResponse
    {
        $quotes = ["A", "B", "C", "D"];
        return new JsonResponse([
            'quote' => $quotes[array_rand($quotes)]
        ]);
    }


    #[Route('/redirect', name: 'redirect')]
    public function redirectToRandom(): RedirectResponse
    {
        return $this->redirectToRoute('redirect');
    }

    #[Route('/articles', name: 'articles')]
    public function articles(): Response
    {
        $articles = [
            [
                'title' => 'Symfony & Twig',
                'content' => 'Introduction au moteur de templates Twig.',
                'popular' => true,
                'author' => 'Théo',
                'date' => new \DateTime('-2 days')
            ],
            [
                'title' => 'Les routes Symfony',
                'content' => 'Comprendre le système de routing.',
                'popular' => false,
                'author' => 'Alice',
                'date' => new \DateTime('-1 month')
            ],
            [
                'title' => 'Contrôleurs Symfony',
                'content' => 'Comment structurer la logique métier.',
                'popular' => true,
                'author' => 'Bob',
                'date' => new \DateTime('now')
            ],
        ];

        return $this->render('home/articles.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig');
    }

    #[Route('/form', name: 'form')]
    public function form(Request $request): Response
    {
        // 1 Créer l’entité
        $product = new Product();

        // 2️ Créer le formulaire
        $form = $this->createForm(ProductType::class, $product);

        // 3 Gérer la requête
        $form->handleRequest($request);

        // 4 Vérifier soumission et validité
        if ($form->isSubmitted() && $form->isValid()) {
            dump($product); // Profiler
            $this->addFlash('success', 'Le produit a été envoyé avec succès ✅');
        }

        // 5 Passer la variable form au template
        return $this->render('home/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
