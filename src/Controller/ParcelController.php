<?php

namespace App\Controller;

use App\Repository\MerchantBillingRepository;
use App\Repository\ParcelMemberRepository;
use App\Repository\LogImgParcelAgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ParcelController extends AbstractController
{
    /**
     * @Route("/parcel/list/member/api", methods={"POST"})
     */
    public function selectParcelMember(Request $request, ParcelMemberRepository $repParcelMember, EntityManagerInterface $em)
    {
        $data = json_decode($request->getContent(), true);
        if($data['branch_id']==''){
            $output=['status'=>'ERROR_DATA_NOT_COMPLETE'];
        } else {
            $conn = $em->getConnection();
            $query = "SELECT member_id,citizenid,firstname,lastname,aliasname,ref_address as address,phoneregis FROM parcel_member where merid=:branch_id";
            $listMember = $conn->prepare($query);
            $listMember->execute(array('branch_id' => $data['branch_id']));

            if($listMember->rowCount() == 0){
                $output=['status'=>'ERROR_DATA_NOT_FOUND'];
            } else {
                $output=['status'=>'SUCCESS',
                    'listMember'=>$listMember];
            }
        }

        return $this->json($output);
    }

    /**
     * @Route("/parcel/check/member/api", methods={"POST"})
     */
    public function checkParcelMemberInfo(Request $request,
                                          EntityManagerInterface $em,
                                          ParcelMemberRepository $repParcelMember)
    {
        $data = json_decode($request->getContent(), true);

        $patternPhone = '/^66\d{9}$/';
        $memberCode = trim($data['member_code']);
        $splMemberCode = str_split($memberCode);

        $resultIdCardCheck=$this->validatePID($data['member_code']);

        $conn = $em->getConnection();
        $query = "SELECT member_id as member_code, merid as branch_id,firstname as first_name, lastname as last_name,phoneregis as phone, ref_address as address, bankacc as bank_account_no,bank_acc_name,bank_issue as bank_name ".
            "FROM parcel_member WHERE merid=:merId AND ";

        if(count($splMemberCode)==13 && $resultIdCardCheck==true){
            $query.="citizenid =:memberCode";
        } else if (count($splMemberCode)==11 && preg_match($patternPhone,$memberCode)){
            $query.="phoneregis =:memberCode";
        } else {
            $query.="member_id =:memberCode";
        }

        $selectMemberInfo = $conn->prepare($query);
        $selectMemberInfo->execute(array('merId'=>$data['merId'],'memberCode' => $memberCode));

        if(count($splMemberCode)==13 && $resultIdCardCheck==true && $selectMemberInfo->rowCount()==0) {
            $conn = $em->getConnection();
            $sql = "SELECT member_id as member_code, merid as branch_id,firstname as first_name, lastname as last_name,phoneregis as phone, ref_address as address, bankacc as bank_account_no,bank_acc_name,bank_issue as bank_name ".
                "FROM parcel_member WHERE merid=:merId AND member_id =:memberCode";
            $queryMemberInfo = $conn->prepare($sql);
            $queryMemberInfo->execute(array('merId'=>$data['merId'],'memberCode' => $memberCode));

            if($queryMemberInfo->rowCount()==0){
                $output=['status'=>'ERROR_NOT_FOUND'];
            } else {
                $resultMemberInfo = json_decode($this->json($queryMemberInfo)->getContent(), true);
                $output = ['status' => 'SUCCESS',
                    'member_code' => $resultMemberInfo[0]['member_code'],
                    'branch_id' => $resultMemberInfo[0]['branch_id'],
                    'first_name' => $resultMemberInfo[0]['first_name'],
                    'last_name' => $resultMemberInfo[0]['last_name'],
                    'phone' => $resultMemberInfo[0]['phone'],
                    'address' => $resultMemberInfo[0]['address'],
                    'bank_account_no' => $resultMemberInfo[0]['bank_account_no'],
                    'bank_acc_name' => $resultMemberInfo[0]['bank_acc_name'],
                    'bank_name' => $resultMemberInfo[0]['bank_name']
                ];
            }
        } else if($selectMemberInfo->rowCount()==0){
            $output=['status'=>'ERROR_NOT_FOUND'];
        } else {
            $memberInfo = json_decode($this->json($selectMemberInfo)->getContent(), true);
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

    /**
     * @Route("/parcel/tax/bill/api", methods={"POST"})
     */
    public function selectTaxBill(Request $request,
                                  EntityManagerInterface $em
    )  {
        $data = json_decode($request->getContent(), true);

        if($data['bill_no']==""){
            $output=['status'=>'ERROR_DATA_NOT_COMPLETE'];
        } else {
            $conn = $em->getConnection();
            $query = "SELECT peak_url_receipt_webview FROM merchant_billing WHERE parcel_bill_no = :bill_no GROUP BY parcel_bill_no LIMIT 0, 1";
            $queryTaxBill = $conn->prepare($query);
            $queryTaxBill->execute(array('bill_no' => $data['bill_no']));

            if($queryTaxBill->rowCount() == 0){
                $output=['status'=>'ERROR_NO_TAX_BILL'];
            } else {
                $taxBillUrl = json_decode($this->json($queryTaxBill)->getContent(), true);

                $output=['status'=>'SUCCESS',
                    'peak_url_receipt_webview'=>$taxBillUrl[0]['peak_url_receipt_webview']];
            }
        }

        return $this->json($output);
    }

    /**
     * @Route("/parcel/select/img/url/api", methods={"POST"})
     */
    public function selectImgUrl(Request $request,
                                 LogImgParcelAgentRepository $repLogImg
    )  {
        $data = json_decode($request->getContent(), true);

        if($data['member_code']=='' || $data['source']==''){
            $output=['status'=>'ERROR_DATA_NOT_COMPLETE'];
        } else {
            $urlImg=$repLogImg->findBy(array('memberId'=>$data['member_code'],'source'=>$data['source']));
            if($urlImg==null){
                $output=['status'=>'ERROR_NO_DATA_IMG'];
            } else {
                $output=['status'=>'SUCCESS',
                         'memberImgIng'=>['imgUrlCitizen'=>$urlImg[0]->getImgUrlCitizen(),
                         'imgUrlBank'=>$urlImg[0]->getImgUrlBank()

                    ]
                ];
            }
        }
        return $this->json($output);
    }
    public function validatePID($pid){
        if(preg_match("/^(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)$/", $pid, $matches)){ //ใช้ preg_match
            if(strlen($pid) != 13){
                $returncheck = false;
            }else{
                $rev = strrev($pid); // reverse string ขั้นที่ 0 เตรียมตัว
                $total = 0;
                for($i=1;$i<13;$i++){ // ขั้นตอนที่ 1 - เอาเลข 12 หลักมา เขียนแยกหลักกันก่อน
                    $mul = $i +1;
                    $count = $rev[$i]*$mul; // ขั้นตอนที่ 2 - เอาเลข 12 หลักนั้นมา คูณเข้ากับเลขประจำหลักของมัน
                    $total = $total + $count; // ขั้นตอนที่ 3 - เอาผลคูณทั้ง 12 ตัวมา บวกกันทั้งหมด
                }
                $mod = $total % 11; //ขั้นตอนที่ 4 - เอาเลขที่ได้จากขั้นตอนที่ 3 มา mod 11 (หารเอาเศษ)
                $sub = 11 - $mod; //ขั้นตอนที่ 5 - เอา 11 ตั้ง ลบออกด้วย เลขที่ได้จากขั้นตอนที่ 4
                $check_digit = $sub % 10; //ถ้าเกิด ลบแล้วได้ออกมาเป็นเลข 2 หลัก ให้เอาเลขในหลักหน่วยมาเป็น Check Digit
                if($rev[0] == $check_digit){  // ตรวจสอบ ค่าที่ได้ กับ เลขตัวสุดท้ายของ บัตรประจำตัวประชาชน
                    $returncheck = true; /// ถ้า ตรงกัน แสดงว่าถูก
                }else{
                    $returncheck = false; // ไม่ตรงกันแสดงว่าผิด
                }
            }
        }else{
            $returncheck = false;
        }
        return $returncheck;
    }
}
