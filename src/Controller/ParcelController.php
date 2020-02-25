<?php

namespace App\Controller;

use App\Repository\MerchantBillingRepository;
use App\Repository\ParcelMemberRepository;
use App\Repository\LogImgParcelAgentRepository;
use App\Repository\GlobalAuthenRepository;
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
            $query = "SELECT member_id,citizenid,firstname,lastname,aliasname,ref_address as address,phoneregis FROM parcel_member WHERE merid=:branch_id AND status=:status";
            $listMember = $conn->prepare($query);
            $listMember->execute(array('branch_id' => $data['branch_id'],'status'=>'active'));

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
        $query = "SELECT member_id as member_code, merid as branch_id,citizenid as citizen_Id,firstname as first_name, lastname as last_name,phoneregis as phone, ref_address as address, bankacc as bank_account_no,bank_acc_name,bank_issue as bank_name ".
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
            $sql = "SELECT member_id as member_code, merid as branch_id,citizenid as citizen_id,firstname as first_name, lastname as last_name,phoneregis as phone, ref_address as address, bankacc as bank_account_no,bank_acc_name,bank_issue as bank_name ".
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
                    'citizen_id' => $resultMemberInfo[0]['citizen_id'],
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
                'citizen_id' => $memberInfo[0]['citizen_id'],
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
        $parcelMember=$repParcelMember->findOneBy(array('memberId'=>$data['member_code'],'status'=>'active'));

        if($parcelMember==null){
            $output=['status'=>'ERROR_MEMBER_NOT_FOUND'];
        } else {
            $output=['status'=>'SUCCESS',
                'member_code'=>$parcelMember
                ];
        }

        return $this->json($output);
    }

    /**
     * @Route("/parcel/check/tracking/list/api", methods={"POST"})
     */
    public function checkTrackingInBilling(Request $request,
                                           MerchantBillingRepository $repMerchantBilling,
                                           ParcelMemberRepository $repParcelMember,
                                           GlobalAuthenRepository $repGlobalAuthen
    )  {
        $data = json_decode($request->getContent(), true);
        $meet_require = true;
        $tracks = [];
        foreach ($data['trackingList'] as $itemTracking) {
            $patternTracking11 = '/^[T|t][D|d][Z|z]+[0-9]{8}?$/i';
            $patternTracking12 = '/^[T|t][D|d][Z|z]+[0-9]{8}[A-Z]?$/i';
            $tracking = trim($itemTracking['tracking']);

            if ((mb_strlen($tracking, 'UTF-8') != 11) && (mb_strlen($tracking, 'UTF-8') != 12)) {
                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                return $this->json($output);
            } elseif ((mb_strlen($tracking, 'UTF-8') == 11) && !(preg_match($patternTracking11, $tracking))) {
                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                return $this->json($output);
            } elseif ((mb_strlen($tracking, 'UTF-8') == 12) && (!preg_match($patternTracking12, $tracking))) {
                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                return $this->json($output);
            } else {
                $tracks[] = $itemTracking['tracking'];
            }
        }
        $checkDupTrack = [];
        if (count($tracks) > 0) {
            foreach ($tracks as $track) {
                if (!array_key_exists($track, $checkDupTrack)) {
                    $checkDupTrack[$track] = 1;
                } else {
                    $checkDupTrack[$track] += 1;
                }
            }
            foreach ($checkDupTrack as $k => $v) {
                if ($v > 1) {
                    $meet_require = false;
                    $errorCheck = "ERROR_DUPLICATE_TRACKING_IN_RAW_DATA";
                } else {
                    $checkParcelRef = $repMerchantBilling->count(array('parcelRef' => $track));
                    if ($checkParcelRef > 0) {
                        $meet_require = false;
                        $errorCheck = "ERROR_DUPLICATE_TRACKING_IN_DB";
                    }
                }
            }
        } else {
            $meet_require = false;
            $errorCheck = "ERROR_TRACKING_NOT_PASS";
        }

        if ($meet_require == false) {
            $output = array('status' => $errorCheck);
        } else {
            $output = array('status' => true);
        }

        return $this->json($output);
    }

    /**
     * @Route("/parcel/validate/tracking/api", methods={"POST"})
     */
    public function checkValidateTracking(Request $request,
                     MerchantBillingRepository $repMerchantBilling,
                     ParcelMemberRepository $repParcelMember,
                     GlobalAuthenRepository $repGlobalAuthen
    )  {
        $data = json_decode($request->getContent(), true);
        $meet_require = true;
        $tracks = [];
        if($data['member_code']=="" || $data['member_code']==null){
            $output = array('status' => 'ERROR_NO_MEMBER_CODE');
            return $this->json($output);
        } else if ($data['user_id']=="" || $data['user_id']==null){
            $output = array('status' => 'ERROR_NO_USER_ID');
            return $this->json($output);
        } else if ($data['branch_id']=="" || $data['branch_id']==null){
            $output = array('status' => 'ERROR_NO_BRANCH_ID');
            return $this->json($output);
        } else if ($data['carrier_id']=="" || $data['carrier_id']==null){
            $output = array('status' => 'ERROR_NO_CARRIER_ID');
            return $this->json($output);
        } else if (count($data['trackingList'])==0){
            $output = array('status' => 'ERROR_NO_TRACKING_LIST');
            return $this->json($output);
        } else {
            $resultIdCardCheck=$this->validatePID($data['carrier_id']);
            if($resultIdCardCheck!== true){
                $output = array('status' => 'ERROR_WRONG_CARRIER_ID');
                return $this->json($output);
            } else {
                $checkMember=$repParcelMember->findOneBy(['memberId'=>$data['member_code'],'status'=>'active']);
                if($checkMember==null){
                    $output = array('status' => 'ERROR_WRONG_MEMBER_CODE');
                    return $this->json($output);
                } else {
                    $checkUserId=$repGlobalAuthen->findOneBy(['id'=>$data['user_id'],'merid'=>$data['branch_id'],'status'=>'active']);
                    if($checkUserId==null){
                        $output = array('status' => 'ERROR_WRONG_USER_ID');
                        return $this->json($output);
                    } else {
                        foreach ($data['trackingList'] as $itemTracking) {
                            $patternTracking11 = '/^[T|t][D|d][Z|z]+[0-9]{8}?$/i';
                            $patternTracking12 = '/^[T|t][D|d][Z|z]+[0-9]{8}[A-Z]?$/i';
                            $tracking = trim($itemTracking['tracking']);

                            if ((mb_strlen($tracking, 'UTF-8') != 11) && (mb_strlen($tracking, 'UTF-8') != 12)) {
                                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                                return $this->json($output);
                            } elseif ((mb_strlen($tracking, 'UTF-8') == 11) && !(preg_match($patternTracking11, $tracking))) {
                                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                                return $this->json($output);
                            } elseif ((mb_strlen($tracking, 'UTF-8') == 12) && (!preg_match($patternTracking12, $tracking))) {
                                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                                return $this->json($output);
                            } else {
                                $tracks[] = $itemTracking['tracking'];
                            }
                        }
                        $checkDupTrack = [];
                        if (count($tracks) > 0) {
                            foreach ($tracks as $track) {
                                if (!array_key_exists($track, $checkDupTrack)) {
                                    $checkDupTrack[$track] = 1;
                                } else {
                                    $checkDupTrack[$track] += 1;
                                }
                            }
                            foreach ($checkDupTrack as $k => $v) {
                                if ($v > 1) {
                                    $meet_require = false;
                                    $errorCheck = "ERROR_DUPLICATE_TRACKING_IN_RAW_DATA";
                                } else {
                                    $checkParcelRef = $repMerchantBilling->count(array('parcelRef' => $track));
                                    if ($checkParcelRef > 0) {
                                        $meet_require = false;
                                        $errorCheck = "ERROR_DUPLICATE_TRACKING_IN_DB";
                                    }
                                }
                            }
                        } else {
                            $meet_require = false;
                            $errorCheck = "ERROR_TRACKING_NOT_PASS";
                        }

                        if ($meet_require == false) {
                            $output = array('status' => $errorCheck);
                        } else {
                            $output = array('status' => true);
                        }

                        return $this->json($output);
                    }
                }
            }
        }
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
