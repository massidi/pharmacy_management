<?php

namespace App\Service;


use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PreparationCommande
{

    /**
     * @var SessionInterface
     */
    private SessionInterface $session;
    /**
     * @var ProductRepository
     */
    private ProductRepository $repository;

    public function __construct(SessionInterface $session,ProductRepository $repository)
    {
        $this->session = $session;
        $this->repository = $repository;
    }

    public function add($id)
    {
        $commande = $this->session->get('precommande', []);

        if (!empty($commande[$id])) {
            $commande[$id]++;
        } else {
            $commande[$id] = 1;

        }
        $this->session->set('precommande', $commande);
    }
    public function decreased($id)
    {
        $commande = $this->session->get('precommande', []);

        if (!empty($commande[$id]>1)) {
            $commande[$id]--;
        }
        else {
            $commande[$id] = 1;

        }

        $this->session->set('precommande', $commande);
    }

    public function get()
    {
        return $this->session->get('precommande');

    }
    public function getFull()
    {
        $commandeComplet = [];

        if($this->get()>1){
            foreach ($this->get()as $id => $quantity) {
                $product_obj=$this->repository->findOneById($id);
                if (!$product_obj)
                {
                    $this->delete($id);
                    continue;
                }
                $commandeComplet[] = [

                    'product' => $product_obj,
                    'quantity' => $quantity

                ];

            }
        }
        return $commandeComplet;
    }

    public function remove()
    {
        return $this->session->remove('precommande');
    }

    public function delete($id)
    {

        $commande = $this->session->get('precommande', []);
        unset($commande[$id]);

        return $this->session->set('precommande', $commande);
    }

}