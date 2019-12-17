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
    public function checkParcelMemberInfo(Request $request,
                                          EntityManagerInterface $em,
                                          ParcelMemberRepository $repParcelMember)
    {
        $data = json_decode($request->getContent(), true);

        $patternPhone = '/^66\d{9}$/';
        $memberCode = trim($data['member_code']);
        $splMemberCode = str_split($memberCode);

        $resultIdCardCheck=$this->validatePID($data['member_code']);

        if(count($splMemberCode)==13 && $resultIdCardCheck==true) {
            $sqlCheckCitizenId = "SELECT member_id as member_code, merid as branch_id,firstname as first_name, lastname as last_name,phoneregis as phone, ref_address as address, bankacc as bank_account_no,bank_acc_name,bank_issue as bank_name " .
                "FROM parcel_member WHERE merid=" . $data['merId'] . " AND citizenid ='" . $memberCode . "'";
            $queryCheckCitizenId = $em->getConnection()->query($sqlCheckCitizenId);
            $memberInfoByCitizenId = json_decode($this->json($queryCheckCitizenId)->getContent(), true);

            if($memberInfoByCitizenId==null) {
                $sqlCheckPhone= "SELECT member_id as member_code, merid as branch_id,firstname as first_name, lastname as last_name,phoneregis as phone, ref_address as address, bankacc as bank_account_no,bank_acc_name,bank_issue as bank_name " .
                    "FROM parcel_member WHERE merid=" . $data['merId'] . " AND phoneregis ='" . $memberCode . "'";
                $queryCheckPhoneregis = $em->getConnection()->query($sqlCheckPhone);
                $memberInfoByPhoneregis = json_decode($this->json($queryCheckPhoneregis)->getContent(), true);

                if($memberInfoByPhoneregis==null){
                    $sqlCheckMemberId = "SELECT member_id as member_code, merid as branch_id,firstname as first_name, lastname as last_name,phoneregis as phone, ref_address as address, bankacc as bank_account_no,bank_acc_name,bank_issue as bank_name " .
                        "FROM parcel_member WHERE merid=" . $data['merId'] . " AND member_id ='" . $memberCode . "'";
                    $queryCheckMemberId = $em->getConnection()->query($sqlCheckMemberId);
                    $memberInfoByMemberId = json_decode($this->json($queryCheckMemberId)->getContent(), true);
                    if($memberInfoByMemberId==null){
                        $output=['status'=>'ERROR_NOT_FOUND'];
                    } else {
                        $output = ['status' => 'SUCCESS',
                            'member_code' => $memberInfoByMemberId[0]['member_code'],
                            'branch_id' => $memberInfoByMemberId[0]['branch_id'],
                            'first_name' => $memberInfoByMemberId[0]['first_name'],
                            'last_name' => $memberInfoByMemberId[0]['last_name'],
                            'phone' => $memberInfoByMemberId[0]['phone'],
                            'address' => $memberInfoByMemberId[0]['address'],
                            'bank_account_no' => $memberInfoByMemberId[0]['bank_account_no'],
                            'bank_acc_name' => $memberInfoByMemberId[0]['bank_acc_name'],
                            'bank_name' => $memberInfoByMemberId[0]['bank_name']
                        ];
                    }
                } else {
                    $output = ['status' => 'SUCCESS',
                        'member_code' => $memberInfoByPhoneregis[0]['member_code'],
                        'branch_id' => $memberInfoByPhoneregis[0]['branch_id'],
                        'first_name' => $memberInfoByPhoneregis[0]['first_name'],
                        'last_name' => $memberInfoByPhoneregis[0]['last_name'],
                        'phone' => $memberInfoByPhoneregis[0]['phone'],
                        'address' => $memberInfoByPhoneregis[0]['address'],
                        'bank_account_no' => $memberInfoByPhoneregis[0]['bank_account_no'],
                        'bank_acc_name' => $memberInfoByPhoneregis[0]['bank_acc_name'],
                        'bank_name' => $memberInfoByPhoneregis[0]['bank_name']
                    ];
                }
            } else {
                $output = ['status' => 'SUCCESS',
                    'member_code' => $memberInfoByCitizenId[0]['member_code'],
                    'branch_id' => $memberInfoByCitizenId[0]['branch_id'],
                    'first_name' => $memberInfoByCitizenId[0]['first_name'],
                    'last_name' => $memberInfoByCitizenId[0]['last_name'],
                    'phone' => $memberInfoByCitizenId[0]['phone'],
                    'address' => $memberInfoByCitizenId[0]['address'],
                    'bank_account_no' => $memberInfoByCitizenId[0]['bank_account_no'],
                    'bank_acc_name' => $memberInfoByCitizenId[0]['bank_acc_name'],
                    'bank_name' => $memberInfoByCitizenId[0]['bank_name']
                ];
            }
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
            $query = "SELECT peak_url_receipt_webview FROM merchant_billing WHERE parcel_bill_no = '" . $data['bill_no'] . "' GROUP BY parcel_bill_no LIMIT 0, 1";
            $queryTaxBill = $em->getConnection()->query($query);
            $taxBillUrl = json_decode($this->json($queryTaxBill)->getContent(), true);

            if($taxBillUrl[0]['peak_url_receipt_webview'] == null){
                $output=['status'=>'ERROR_NO_TAX_BILL'];
            } else {
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
