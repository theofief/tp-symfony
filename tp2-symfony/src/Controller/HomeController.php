<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return new Response('<nav>
    <a href="/">Accueil</a> |
    <a href="/hello/user">Hello</a> |
    <a href="/about">À propos</a> |
    <a href="/random">Citation</a>
</nav>
<hr>
<h1>Bienvenue sur mon application Symfony 🚀</h1>');
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
            "Symfony, c’est propre.",
            "Le backend, c’est la base.",
            "Twig simplifie la vie.",
            "Coder, c’est créer."
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
        return $this->redirectToRoute('random');
    }
}
