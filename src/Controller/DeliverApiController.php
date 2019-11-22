<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\CounterData;
use App\Repository\MerchantBillingRepository;

class DeliverApiController extends AbstractController
{
    /**
     * @Route("/deliver/api", name="deliver_api")
     */
    public function index()
    {
        return $this->render('deliver_api/index.html.twig', [
            'controller_name' => 'DeliverApiController',
        ]);
    }
}
