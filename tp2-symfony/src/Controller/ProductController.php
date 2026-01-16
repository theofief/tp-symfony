<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/new', name: 'product_new')]
    public function new(Request $request): Response
    {
        // 1 Instancier l’entité
        $product = new Product();

        // 2 Créer le formulaire à partir du Type
        $form = $this->createForm(ProductType::class, $product);

        // 3 Écouter la requête
        $form->handleRequest($request);

        // 4 Vérifier soumission + validité
        if ($form->isSubmitted() && $form->isValid()) {

            // 5 Envoyer les données vers le Profiler
            dump($product);

            // Message de confirmation
            $this->addFlash(
                'success',
                'Le produit a été envoyé avec succès ✅'
            );
        }

        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}