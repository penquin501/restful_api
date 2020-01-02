<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service/search/data/address/api", methods={"GET"})
     */
    public function searchDataAddress(Request $request,EntityManagerInterface $em)
    {
        $keyword = $request->query->get('keyword');

        $conn = $em->getConnection();
        $query = "SELECT d.DISTRICT_NAME,a.AMPHUR_NAME, p.PROVINCE_NAME,z.zipcode,z.DHL_SLA " .
            "FROM postinfo_district d " .
            "JOIN postinfo_amphur a ON d.AMPHUR_ID=a.AMPHUR_ID " .
            "JOIN postinfo_province p ON d.PROVINCE_ID=p.PROVINCE_ID " .
            "JOIN postinfo_zipcodes z ON d.DISTRICT_CODE=z.district_code " .
            "WHERE d.DISTRICT_NAME = :keyword OR a.AMPHUR_NAME = :keyword";
        $listAddress = $conn->prepare($query);
        $listAddress->execute(array('keyword' => $keyword));

        if($listAddress->rowCount() == 0){
            $output=['status'=>'ERROR_NOT_FOUND'];
        } else {
            $output=['status'=>'SUCCESS','addressInfo'=>$listAddress];
        }
        return $this->json($output);
    }

    /**
     * @Route("/service/search/data/zipcode/api", methods={"GET"})
     */
    public function searchDataZipcode(Request $request,EntityManagerInterface $em)
    {
        $zipcode = $request->query->get('zipcode');

        $conn = $em->getConnection();
        $query = "SELECT d.DISTRICT_NAME,a.AMPHUR_NAME, p.PROVINCE_NAME,z.zipcode,z.DHL_SLA " .
            "FROM postinfo_district d " .
            "JOIN postinfo_amphur a ON d.AMPHUR_ID=a.AMPHUR_ID " .
            "JOIN postinfo_province p ON d.PROVINCE_ID=p.PROVINCE_ID " .
            "JOIN postinfo_zipcodes z ON d.DISTRICT_CODE=z.district_code " .
            "WHERE z.zipcode = :zipcode";
        $listAddress = $conn->prepare($query);
        $listAddress->execute(array('zipcode' => $zipcode));

        if($listAddress->rowCount() == 0){
            $output=['status'=>'ERROR_NOT_FOUND'];
        } else {
            $output=['status'=>'SUCCESS','addressInfo'=>$listAddress];
        }
        return $this->json($output);
    }

    /**
     * @Route("/service/select/data/zipcode/api", methods={"GET"})
     */
    public function selectDataZipcode(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $sql = "SELECT DISTINCT zipcode FROM postinfo_zipcodes WHERE zipcode != '00000' ORDER BY zipcode ASC";

        $listAddress = $entityManager->getConnection()->query($sql);
        return $this->json($listAddress);
    }
}
