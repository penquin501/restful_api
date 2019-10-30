<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ThaipostServiceController extends AbstractController
{
    /**
     * @Route("/thaipost/service/search/mailcode/api", methods={"GET"})
     */
    public function searchMailCode(Request $request)
    {
        $sendMailDate = $request->query->get('sendMailDate');

        $entityManager = $this->getDoctrine()->getManager();
        $sql = "SELECT mailcode FROM merchant_billing_delivery WHERE transporter_id=99 AND DATE(sendmaildate) = '".$sendMailDate."'";
        $listMailCode = $entityManager->getConnection()->query($sql);
        $mailCode = json_decode($this->json($listMailCode)->getContent(), true);

        if($mailCode == null){
            $output=['status'=>'ERROR_NOT_FOUND'];
        } else {
            $output=['status'=>'SUCCESS','listMailCode'=>$mailCode];
        }

        return $this->json($output);
    }
}
