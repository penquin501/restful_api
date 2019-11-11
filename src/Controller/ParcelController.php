<?php

namespace App\Controller;

use App\Repository\MerchantBillingRepository;
use App\Repository\ParcelMemberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ParcelController extends AbstractController
{
    /**
     * @Route("/parcel/list/member/api", methods={"POST"})
     */
    public function selectParcelMember(Request $request, ParcelMemberRepository $repParcelMember)
    {
//        header("Access-Control-Allow-Origin: *");
        $data = json_decode($request->getContent(), true);
        if($data['branch_id']==''){
            $output=['status'=>'ERROR_DATA_NOT_COMPLETE'];
        } else {
            $entityManager = $this->getDoctrine()->getManager();
            $sql = "SELECT member_id,citizenid,firstname,lastname,aliasname,ref_address as address,phoneregis FROM parcel_member where merid=".$data['branch_id'];
            $listMember = $entityManager->getConnection()->query($sql);
            $memberInfo=json_decode($this->json($listMember)->getContent(), true);

            if(count($memberInfo)==0){
                $output=['status'=>'ERROR_DATA_NOT_FOUND'];
            } else {
                $output=['status'=>'SUCCESS',
                    'listMember'=>$memberInfo];
            }
        }

        return $this->json($output);
    }

    /**
     * @Route("/parcel/check/member/api", methods={"POST"})
     */
    public function checkParcelMemberInfo(Request $request, ParcelMemberRepository $repParcelMember)
    {
        $data = json_decode($request->getContent(), true);

        $entityManager = $this->getDoctrine()->getManager();
        $sql = "SELECT member_id as member_code, merid as branch_id,firstname as first_name, lastname as last_name,phoneregis as phone, ref_address as address, bankacc as bank_account_no,bank_acc_name,bank_issue as bank_name ".
            "FROM parcel_member WHERE merid=".$data['merId']." AND ";

        $patternId = '/^([1-9]{1})\d{12}$/';
        $patternPhone = '/^66\d{9}$/';
        $memberCode = trim($data['member_code']);
        $splMemberCode = str_split($memberCode);

        if(count($splMemberCode)==13 && preg_match($patternId,$memberCode)){
            $sql.="citizenid ='" . $memberCode."'";
        } elseif(count($splMemberCode)==11 && preg_match($patternPhone,$memberCode)) {
            $sql.="phoneregis ='" . $memberCode."'";
        } else {
            $sql.="member_id ='" . $memberCode."'";
        }

        $selectMemberInfo = $entityManager->getConnection()->query($sql);
        $memberInfo = json_decode($this->json($selectMemberInfo)->getContent(), true);

        if($memberInfo==[]){
            $output=['status'=>'ERROR_NOT_FOUND'];
        } else {
            $output = ['status' => 'SUCCESS',
                'member_code' => $memberInfo[0]['member_code'],
                'branch_id' => $memberInfo[0]['branch_id'],
                'first_name' => $memberInfo[0]['first_name'],
                'last_name' => $memberInfo[0]['last_name'],
                'phone' => $memberInfo[0]['phone'],
                'address' => $memberInfo[0]['address'],
                'bank_account_no' => $memberInfo[0]['bank_account_no'],
                'bank_acc_name' => $memberInfo[0]['bank_acc_name'],
                'bank_name' => $memberInfo[0]['bank_name']
            ];
        }

        return $this->json($output);
    }
    /**
     * @Route("/parcel/select/member/api", methods={"POST"})
     */
    public function selectMemberInfo(Request $request, ParcelMemberRepository $repParcelMember)
    {
        $data = json_decode($request->getContent(), true);
        $parcelMember=$repParcelMember->findOneBy(array('memberId'=>$data['member_code']));

        if($parcelMember==null){
            $output=['status'=>'ERROR_MEMBER_NOT_FOUND'];
        } else {
            $output=['status'=>'SUCCESS',
                'memberInfo'=>$parcelMember
                ];
        }

        return $this->json($output);
    }

    /**
     * @Route("/parcel/check/tracking/list/api", methods={"POST"})
     */
    public function checkTrackingInBilling(Request $request,
                                           MerchantBillingRepository $repMerchantBilling
    )  {
        $data = json_decode($request->getContent(), true);
        $meet_require = true;
        $tracks = [];
        foreach ($data['trackingList'] as $itemTracking) {
            $patternTracking11 = '/^[T|t][D|d][Z|z]+[0-9]{8}?$/i';
            $patternTracking12 = '/^[T|t][D|d][Z|z]+[0-9]{8}[A-Z]?$/i';
            $tracking = trim($itemTracking['tracking']);

            if((mb_strlen($tracking, 'UTF-8')!=11) && (mb_strlen($tracking, 'UTF-8')!=12)){
                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                return $this->json($output);
            } elseif ((mb_strlen($tracking, 'UTF-8')==11) && !(preg_match($patternTracking11, $tracking))) {
                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                return $this->json($output);
            } elseif ((mb_strlen($tracking, 'UTF-8')==12) && (!preg_match($patternTracking12, $tracking))) {
                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                return $this->json($output);
            } else {
                $tracks[] = $itemTracking['tracking'];
            }
        }
        if(count($tracks)>0){
            foreach ($tracks as $track) {
                $checkParcelRef = $repMerchantBilling->count(array('parcelRef' => $track));
                if($checkParcelRef>0){
                    $meet_require = false;
                }
            }
        } else {
            $meet_require = false;
        }

        if ($meet_require == false) {
            $output = array('status' => 'ERROR_TRACKING_DUPLICATED');

        } else {
            $output = array('status' => true);
        }

        return $this->json($output);
    }
}
