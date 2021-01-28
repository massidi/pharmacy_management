<?php

namespace App\Controller;

use App\Repository\OrderDetailsRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PharmacyController extends AbstractController
{
    /**
     * @var OrderDetailsRepository
     */
    private OrderDetailsRepository $orderDetailsRepository;

    public function __construct(OrderDetailsRepository $orderDetailsRepository)
    {
        $this->orderDetailsRepository = $orderDetailsRepository;
    }

    /**
     * @Route("/", name="pharmacy")
     * @param ProductRepository $productRepository
     * @return Response
     */
    public function index(ProductRepository $productRepository): Response
    {
        $orderbymonth = $this->orderDetailsRepository->findByMonth();
//dd($orderbymonth);

        $orderbyday = $this->orderDetailsRepository->findByDay();
//        dd($orderbyday);

        return $this->render('pharmacy/index.html.twig', [
            'nbr_produit' => $productRepository->findAll(),
            'orderbymonth' => $orderbymonth,
            'orderbyday' => $orderbyday,
        ]);
    }

}
