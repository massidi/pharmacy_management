<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\OrderDetails;
use App\Form\ClientType;
use App\Repository\OrderDetailsRepository;
use App\Service\PreparationCommande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyOrderController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;
    /**
     * @var PreparationCommande
     */
    private PreparationCommande $commande;

    public function __construct(EntityManagerInterface $manager,PreparationCommande $commande)
    {

        $this->manager = $manager;
        $this->commande = $commande;
    }
    /**
     * @Route("/commande/order/index", name="my_order")
     *
     */
    public function index(OrderDetailsRepository $orderDetailsRepository): Response
    {

        return $this->render('my_order/index.html.twig', [
            'orderDetail' => $orderDetailsRepository->findAll(),
        ]);
    }
    /**
     * @Route("/commande/order/new", name="my_order_new")
     *
     */
    public function new(Request $request ,PreparationCommande $preparationCommande): Response
    {

        $commande1=$this->commande->getFull();
        $client=new Client();
        $form=$this->createForm(ClientType::class,$client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            //get name of client from the form
//           $order=$form->get('name')->getData();
            $this->manager->persist($client);

            //get commande value from session and assign it in orderDetails
            foreach ($commande1 as $item )
            {
                $date=new \DateTime();
                $orderDaitals= new OrderDetails();
                $orderDaitals->setClient($client);
                $orderDaitals->setPrice($item['product']->getPrice());
                $orderDaitals->setProduct($item['product']->getName());
                $orderDaitals->setquantity($item['product']->getQuantity());
                $orderDaitals->setTotal($item['product']->getPrice() * $item['quantity']);
                $orderDaitals->setCreatedAt($date);
                $this->manager->persist($orderDaitals);
            }
//            dd($client);
            $this->manager->flush();
//            $preparationCommande->remove();
            $this->addFlash('success','votre commande  a été bien payer');
            return $this->redirectToRoute('my_order');

        }

        return $this->render('my_order/new.html.twig', [
            'form' => $form->createView(),
            'commande'=>$commande1
        ]);
    }
}
