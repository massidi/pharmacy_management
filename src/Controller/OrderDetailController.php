<?php

namespace App\Controller;

use App\Repository\OrderDetailsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderDetailController extends AbstractController
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
     * @Route("/order/detail/by-month", name="total_order_month")
     */
    public function index(OrderDetailsRepository $orderDetailsRepository): Response
    {

        $orderDetail = $this->orderDetailsRepository->findByMonth();

        return $this->render('order_detail/index.html.twig',
            [
                'orderDetail' => $orderDetail,
            ]);
    }

    /**
     * @Route("/order/detail/order-by-day" , name="total_order_day")
     */
    public function day()
    {

        $orderbyday = $this->orderDetailsRepository->findByDay();

        return $this->render('order_detail/day.html.twig',
            [
                'orderbyday' => $orderbyday,
            ]
        );
    }
}
