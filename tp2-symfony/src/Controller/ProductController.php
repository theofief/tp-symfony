<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product/new', name: 'product_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // 1 Instancier l’entité
        $product = new Product();

        // 2 Créer le formulaire à partir du Type
        $form = $this->createForm(ProductType::class, $product);

        // 3 Écouter la requête
        $form->handleRequest($request);

        // 4 Vérifier soumission + validité
        if ($form->isSubmitted() && $form->isValid()) {

            // Définir la date de création si elle n'est pas fournie
            if (!$product->getCreatedAt()) {
                $product->setCreatedAt(new \DateTime());
            }

            // 5 Persister l'entité en base de données
            $entityManager->persist($product);
            $entityManager->flush();

            // Message de confirmation
            $this->addFlash(
                'success',
                'Le produit a été créé avec succès ✅'
            );

            // Redirection vers la liste
            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/products', name: 'product_list')]
    public function list(ProductRepository $productRepository): Response
    {
        // Récupère tous les produits depuis la base de données
        $products = $productRepository->findAll();

        return $this->render('product/list.html.twig', [
            'products' => $products,
        ]);
    }
}