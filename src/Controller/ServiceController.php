<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service/search/data/address/api", methods={"GET"})
     */
    public function searchDataAddress(Request $request)
    {
        $keyword = $request->query->get('keyword');

        $entityManager = $this->getDoctrine()->getManager();
        $sql = "SELECT d.DISTRICT_NAME,a.AMPHUR_NAME, p.PROVINCE_NAME,z.zipcode,z.DHL_SLA " .
            "FROM postinfo_district d " .
            "JOIN postinfo_amphur a ON d.AMPHUR_ID=a.AMPHUR_ID " .
            "JOIN postinfo_province p ON d.PROVINCE_ID=p.PROVINCE_ID " .
            "JOIN postinfo_zipcodes z ON d.DISTRICT_CODE=z.district_code " .
            "WHERE d.DISTRICT_NAME = '".$keyword."' OR a.AMPHUR_NAME = '".$keyword."'";
        $listDistrict = $entityManager->getConnection()->query($sql);
        $addressInfo = json_decode($this->json($listDistrict)->getContent(), true);

        if($addressInfo == null){
            $output=['status'=>'ERROR_NOT_FOUND'];
        } else {
            $output=['status'=>'SUCCESS','addressInfo'=>$addressInfo];
        }
        return $this->json($output);
    }
}
