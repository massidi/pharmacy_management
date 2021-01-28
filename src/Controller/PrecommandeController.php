<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\PreparationCommande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrecommandeController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/commande/preparation_de_commande", name="precommande")
     */
    public function index(PreparationCommande $commande): Response
    {


        return $this->render('precommande/index.html.twig',
            [
                'commande' => $commande->getFull()
            ]
        );
    }

    /**
     * @Route("/precommande/add/{id}", name="add_precommande")
     * @param $id
     * @param PreparationCommande $commande
     * @return Response
     */
    public function add($id, PreparationCommande $commande, Request $request): Response
    {

        return $this->redirectToRoute('product_index');
    }

    /**
     * @Route("/precommande/increased/{id}", name="increased_quantity")
     * @param $id
     * @param PreparationCommande $commande
     * @return Response
     */

    public function increased($id, PreparationCommande $commande, Request $request): Response
    {

        $commande->add($id);
        return $this->redirectToRoute('precommande');
    }


    /**
     * @Route("/precommande/decrease/{id}", name="decrease_precommande")
     * @param $id
     * @param PreparationCommande $commande
     * @return Response
     */
    public function decreased($id, PreparationCommande $commande): Response
    {
        $commande->decreased($id);

        return $this->redirectToRoute('precommande');
    }

    /**
     * @Route("/precommande/remove", name="remove_precommande")
     * @param PreparationCommande $commande
     * @return Response
     */
    public function removed(PreparationCommande $commande): Response
    {
        $commande->remove();
        return $this->redirectToRoute('pharmacy');


    }

    /**
     * @Route("/precommande/delete/{id}", name="delete_precommande")
     * @param PreparationCommande $commande
     * @return Response
     */
    public function delete(PreparationCommande $commande, $id): Response
    {
        $commande->delete($id);
        return $this->redirectToRoute('precommande');


    }
}
