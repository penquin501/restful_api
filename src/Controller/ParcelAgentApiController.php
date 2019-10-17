<?php

namespace App\Controller;

use App\Repository\CheckParcelDropRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\ParcelMember;
use App\Entity\LogImgParcelAgent;
use App\Entity\CheckParcelDrop;
use App\Entity\MerchantBilling;
use App\Entity\MerchantBillingDelivery;
use App\Entity\MerchantBillingDetail;
use App\Entity\MerchantBillingGeninv;

use App\Repository\MerchantConfigRepository;
use App\Repository\ParcelMemberRepository;
use App\Repository\GlobalAuthenRepository;
use App\Repository\MerchantBillingRepository;
use App\Repository\GlobalProductImageRepository;
use App\Repository\GlobalProductRepository;
use App\Repository\GlobalWarehouseRepository;
use App\Repository\MerchantProductRepository;
use App\Repository\PostinfoZipcodesRepository;
use App\Repository\GlobalBankIssueRepository;
use App\Repository\LogImgParcelAgentRepository;

class ParcelAgentApiController extends AbstractController
{
    ////////////////////////////////////////////////////Member Part/////////////////////////////////////////////////////
    /**
     * @Route("/parcel/agent/check/global/authen/api", methods={"POST"})
     */
    public function checkGlobalAuthen(Request $request,
                                      GlobalAuthenRepository $repGlobalAuthen
    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);

        if ($data['apikey'] == "XbOiHrrpH8aQXObcWj69XAom1b0ac5eda2b") {
            $parcelMember = $repGlobalAuthen->findParcelMember($data['phoneno']);

            if ($parcelMember == null) {
                $output = array("status" => "ERROR_NO_MEMBER");
            } else {
                $output = array("status" => "SUCCESS",
                    "memberInfo" => $parcelMember
                );
            }
        } else {
            $output = array("status" => "ERROR_LOGIN_FAIL");
        }
        return $this->json($output);
    }

    /**
     * @Route("/parcel/agent/check/sender/member/api",  methods={"POST"})
     */
    public function checkSenderMember(Request $request,
                                      ParcelMemberRepository $repParcelMember,
                                      MerchantConfigRepository $repMerchantConfig
    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);

        $senderInfo = $repParcelMember->findBy(array('username' => $data['phoneno']));

        if ($senderInfo == null) {
            $output = array("status" => "ERROR_NO_MEMBER");
        } else {
            $merchantName = $repMerchantConfig->findMerchantName($senderInfo[0]->getMerid());
            if ($merchantName == null) {
                $output = array("status" => "ERROR_NO_MERCHANT");
            } else {
                $output = array("status" => "SUCCESS",
                    "senderMemberId" => $senderInfo[0]->getMemberId(),
                    "senderName" => $senderInfo[0]->getFirstname() . ' ' . $senderInfo[0]->getLastname(),
                    "senderMerId" => $senderInfo[0]->getMerid(),
                    "senderCodStatus" => $senderInfo[0]->getBankInfoProven(),
                    "senderShopOrigin" => $merchantName[0]['merchantName']
                );
            }
        }
        return $this->json($output);
    }

    /**
     * @Route("/parcel/agent/check/agent/drop/post", methods={"POST"})
     */
    public function checkAgentDrop(Request $request,
                                   GlobalAuthenRepository $repGlobalAuthen,
                                   ParcelMemberRepository $repParcelMember,
                                   MerchantConfigRepository $repMerchantConfig
    )
    {
        $data = json_decode($request->getContent(), true);
        $agentMember = $repGlobalAuthen->findBy(array('phoneno' => $data['phoneno']));
        $parcelMemberInfo = $repParcelMember->findBy(array('username' => $data['phoneno']));
        $merchantName = $repMerchantConfig->findBy(array('takeorderby' => $agentMember[0]->getMerid()));
        if ($agentMember == null) {
            $output = array("status" => "ERROR_NO_MEMBER");
        } elseif (count($agentMember) > 1) {
            $output = array("status" => "ERROR_DUPLICATED_MEMBER");
        } else {
            $output = array("status" => "SUCCESS",
                "agentUserId" => $agentMember[0]->getId(),
                "agentMerId" => $agentMember[0]->getMerid(),
                "agentFName" => $agentMember[0]->getFname(),
                "agentMemberId" => $parcelMemberInfo[0]->getMemberId(),
                "agentPhone" => $agentMember[0]->getPhoneno(),
                "agentShopOrigin" => $merchantName[0]->getMerchantname()
            );
        }
        return $this->json($output);
    }

    /**
     * @Route("/parcel/agent/register/api", methods={"POST"})
     */
    public function registerMember(Request $request,
                                   EntityManagerInterface $em,
                                   ParcelMemberRepository $repParcelMember
    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);
        $sumMerId = 0;
        $sumCountMember = 0;
        $sumDateRecord = 0;
        $countOnParcelMember = $repParcelMember->count(array('merid' => $data['merId']));
        if ($data['merId'] == '' ||
            $data['citizenId'] == '' ||
            $data['firstName'] == '' ||
            $data['lastName'] == '' ||
            $data['phone'] == '' ||
            $data['imgCitizenIdUrl'] == '' ||
            $data['imgCitizenIdUrl'] == 'noImg' ||
            $data['imgCitizenIdUrl'] == 'noimg' ||
            $data['imgCitizenIdUrl'] == 'noImage'
        ) {
            $output = array('status' => "ERROR_DATA_NOT_COMPLETE");
        } else {
            ///////////////////////////////////////All Info for Member Id///////////////////////////////////////////////
            $splMerId = str_split($data['merId']);
            foreach ($splMerId as $itemMerId) {
                $sumMerId += intval($itemMerId);
            }

            $splCountMember = str_split($countOnParcelMember + 1);
            foreach ($splCountMember as $ItemCountMember) {
                $sumCountMember += intval($ItemCountMember);
            }

            $dateInput = date("ymd");
            $splDateRecord = str_split($dateInput);
            foreach ($splDateRecord as $itemDate) {
                $sumDateRecord += intval($itemDate);
            }
            $strSumMember = strval($sumMerId + $sumCountMember + $sumDateRecord);
            $splSumMember = str_split($strSumMember);

            $memberId = $data['merId'] . ($countOnParcelMember + 1) . $dateInput . $splSumMember[count($splSumMember) - 1];
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $pattern = '/^0\d{9}$/';
            $phoneNO = trim($data['phone']);
            if (preg_match($pattern, $phoneNO)) {
                $arr = str_split($phoneNO);
                if (isset($arr[0])) {
                    if ($arr[0] == '0') {
                        $phoneNO = '66';
                        $passCode = '';
                        for ($i = 1; $i < count($arr); $i++) {
                            $phoneNO .= $arr[$i];
                        }
                        for ($j = 6; $j < count($arr); $j++) {
                            $passCode .= $arr[$j];
                        }
                    }
                }
            }
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            if ($data['address'] == '') {
                $address = null;
            } else {
                $address = $data['address'];
            }
            if ($data['imgBookBankUrl'] == '') {
                $imgBankUrl = null;
                $rawDataBank = null;
                $recordDateBank = null;
            } else {
                $imgBankUrl = $data['imgBookBankUrl'];
                $rawDataBank = $request->getContent();
                $recordDateBank = new \DateTime("now", new \DateTimeZone('Asia/Bangkok'));
            }
            $logImg = new LogImgParcelAgent();
            $logImg->setMemberId($memberId);
            $logImg->setImgUrlCitizen($data['imgCitizenIdUrl']);
            $logImg->setImgUrlBank($imgBankUrl);
            $logImg->setRawDataRegister($request->getContent());
            $logImg->setRawDataBank($rawDataBank);
            $logImg->setRecordDateRegister(new \DateTime("now", new \DateTimeZone('Asia/Bangkok')));
            $logImg->setRecordDateBank($recordDateBank);
            $logImg->setSource('agent_register');
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $parcelMember = new ParcelMember();
            $parcelMember->setMerid($data['merId']);
            $parcelMember->setMemberId($memberId);
            $parcelMember->setCitizenid($data['citizenId']);
            $parcelMember->setFirstname($data['firstName']);
            $parcelMember->setLastname($data['lastName']);
            $parcelMember->setAliasname($data['aliasName']);
            $parcelMember->setRefAddress($address);
            $parcelMember->setPhoneregis($phoneNO);
            $parcelMember->setUsername($phoneNO);
            $parcelMember->setPasscode($passCode);
            $parcelMember->setBankacc($data['bankAcc']);
            $parcelMember->setBankIssue($data['bankIssue']);
            $parcelMember->setBankAccName($data['bankAccName']);
            $parcelMember->setBankInfoProven('pass');
            $parcelMember->setMemberTransferFee(20);
            $parcelMember->setPeakValue('');
            $parcelMember->setStatus('active');

            $em->persist($logImg);
            $em->persist($parcelMember);
            $em->flush();

            $output = array('status' => "SUCCESS");
        }
        return $this->json($output);
    }

    /**
     * @Route("/parcel/agent/generate/memberid/api", methods={"POST"})
     */
    public function genMemberId(Request $request,
                                EntityManagerInterface $em,
                                ParcelMemberRepository $repParcelMember
    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);
//        $countOnParcelMember = $repParcelMember->count(array('merid' => $data['branch_id']));
        $countOnParcelMember = $data['maxMember'];
        $sumMerId = 0;
        $sumCountMember = 0;
        $sumDateRecord = 0;

        if ($countOnParcelMember == 0 || $countOnParcelMember == '') {
            $output = array('status' => "ERROR_NO_MER_ID");
        } else {
            ///////////////////////////////////////All Info for Member Id///////////////////////////////////////////////
            $splMerId = str_split($data['branch_id']);
            foreach ($splMerId as $itemMerId) {
                $sumMerId += intval($itemMerId);
            }

            $splCountMember = str_split($countOnParcelMember + 1);
            foreach ($splCountMember as $ItemCountMember) {
                $sumCountMember += intval($ItemCountMember);
            }

            $dateInput = date("ymd");
            $splDateRecord = str_split($dateInput);
            foreach ($splDateRecord as $itemDate) {
                $sumDateRecord += intval($itemDate);
            }
            $strSumMember = strval($sumMerId + $sumCountMember + $sumDateRecord);
            $splSumMember = str_split($strSumMember);

            $memberId = $data['branch_id'] . ($countOnParcelMember + 1) . $dateInput . $splSumMember[count($splSumMember) - 1];
            $output = array('status' => "SUCCESS",
                'memberId' => $memberId);
        }
        return $this->json($output);
    }

    /**
     * @Route("/parcel/agent/update/cod/register/api", methods={"POST"})
     */
    public function updateCodRegister(Request $request,
                                      EntityManagerInterface $em,
                                      ParcelMemberRepository $repParcelMember,
                                      LogImgParcelAgentRepository $repImgParcelAgent

    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);
        $parcelMemberInfo = $repParcelMember->findOneBy(array('phoneregis' => $data['phoneRegis']));

        if ( $data['phoneRegis'] == '' || $data['address'] == '' || $data['bankAccName'] == '' || $data['bankIssue'] == '' || $data['bankAcc'] == '' || $data['imgBookBankUrl'] == '') {
            $output = array('status' => "ERROR_DATA_NOT_COMPLETE");
        } elseif ($parcelMemberInfo == null) {
            $output = ['status' => 'Error_No_Member_Info'];
        } else {
            $parcelMemberInfo->setRefAddress($data['address']);
            $parcelMemberInfo->setBankacc($data['bankAcc']);
            $parcelMemberInfo->setBankAccName($data['bankAccName']);
            $parcelMemberInfo->setBankIssue($data['bankIssue']);

            $imgBankInfo = $repImgParcelAgent->findOneBy(array('memberId' => $parcelMemberInfo->getMemberId()));

            if ($imgBankInfo == null) {
                $logImg = new LogImgParcelAgent();
                $logImg->setMemberId($parcelMemberInfo->getMemberId());
//                    $logImg->setImgUrlCitizen($data['imgUrl']);
                $logImg->setImgUrlBank($data['imgBookBankUrl']);
//                    $logImg->setRawDataRegister($request->getContent());
                $logImg->setRawDataBank($request->getContent());
                $logImg->setRecordDateBank(new \DateTime("now", new \DateTimeZone('Asia/Bangkok')));
                $em->persist($logImg);
            } else {
                $imgBankInfo->setImgUrlBank($data['imgBookBankUrl']);
                $imgBankInfo->setRawDataBank($request->getContent());
                $imgBankInfo->setRecordDateBank(new \DateTime("now", new \DateTimeZone('Asia/Bangkok')));
            }

            $em->flush();
            $output = ['status' => 'SUCCESS'];
        }
        return $this->json($output);
    }

    /**
     * @Route("/parcel/agent/zipcode/thailand", methods={"GET"})
     */
    public function selectZipcodeThailand(Request $request,
                                          PostinfoZipcodesRepository $repZipcode
    )
    {
        $zipcode = $request->query->get('zipcode');

        $entityManager = $this->getDoctrine()->getManager();
        $sql = "SELECT z.zipcode,d.DISTRICT_ID,d.DISTRICT_CODE,d.DISTRICT_NAME,d.AMPHUR_ID,a.AMPHUR_NAME,d.PROVINCE_ID,p.PROVINCE_NAME " .
            "FROM postinfo_zipcodes z " .
            "JOIN postinfo_district d ON z.district_code=d.DISTRICT_CODE " .
            "JOIN postinfo_amphur a ON d.AMPHUR_ID=a.AMPHUR_ID " .
            "JOIN postinfo_province p ON d.PROVINCE_ID=p.PROVINCE_ID " .
            "WHERE z.zipcode='" . $zipcode . "'";
        $thailandInfo = $entityManager->getConnection()->query($sql);

        return $this->json($thailandInfo);
    }

    /**
     * @Route("/parcel/agent/bank/name", methods={"GET"})
     */
    public function selectBankName(GlobalBankIssueRepository $repBankIssue)
    {
        $bankInfo = $repBankIssue->findBy(array('status' => 'active'));
        return $this->json($bankInfo);
    }

    /**
     * @Route("/parcel/list/member/api", methods={"POST"})
     */
    public function selectParcelMember(Request $request, ParcelMemberRepository $repParcelMember)
    {
        header("Access-Control-Allow-Origin: *");
        $data = json_decode($request->getContent(), true);

        $entityManager = $this->getDoctrine()->getManager();
        $sql = "SELECT member_id,citizenid,firstname,lastname,aliasname,ref_address as address,phoneregis FROM parcel_member where merid=".$data['branch_id'];
        $listMember = $entityManager->getConnection()->query($sql);

        return $this->json($listMember);
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
    ////////////////////////////////////////////////////Quick Link Part/////////////////////////////////////////////////

    /**
     * @Route("/parcel/agent/quicklink/api", methods={"POST"})
     */
    public function parcelAgentQuickLinkPost(Request $request,
                                             EntityManagerInterface $em,
                                             MerchantProductRepository $repMerchantProduct,
                                             MerchantConfigRepository $repMerchantConfig,
                                             PostinfoZipcodesRepository $repZipcode,
                                             GlobalProductRepository $repGlobalProduct,
                                             ParcelMemberRepository $repParcelMember,
                                             GlobalProductImageRepository $repGlobalProductImg,
                                             GlobalWarehouseRepository $repGlobalWarehouse
    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);
        $dateToday = date("Y-m-d H:i:s", strtotime("now"));
        $dateExpire = date("Y-m-d H:i:s", strtotime("now" . "+3 Days"));

        if ($data['agentMerId'] != $data['senderMerId']) {
            $output = array('status' => 'ERROR_MER_ID_NOT_MATCH');
        } else {
            ///////////////////////////////////////////GEN PARCEL BILL NO///////////////////////////////////////////////
            $parcelBillNo = $data['agentMerId'] . '-' . $data['agentUserId'] . '-' . date("ymdHis") . '-' . rand(111, 999);
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            foreach ($data['trackingList'] as $item) {
                $patternTracking11 = '/^[T|t][D|d][Z|z]+[0-9]{8}?$/i';
                $patternTracking12 = '/^[T|t][D|d][Z|z]+[0-9]{8}[A-Z]?$/i';
                $tracking = trim($item['tracking']);
                $newTrackingArr = str_split($tracking);
                if ((count($newTrackingArr) == 11) && (!preg_match($patternTracking11, $tracking))) {
                    $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                } elseif ((count($newTrackingArr) == 12) && (!preg_match($patternTracking12, $tracking))) {
                    $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                } else {
                    //////////////////////////////////////GEN TRANSPORT PRICE///////////////////////////////////////////////
                    $districtCode = $repZipcode->findBy(array('zipcode' => $item['zipcode']));
                    $provinceId = str_split($districtCode[0]->getDistrictCode());

                    if ($item['transportType'] == 'normal' && $item['zipcode'] == '13180' && $item['provinceId'] == '4') {
                        //normal-ปทุมธานี
                        $productIdSize = [17945, 171313, 17946, 17947, 17948, 17949, 17950, 17951, 17952];
                    } elseif ($item['transportType'] == 'normal' && $item['zipcode'] == '13180' && $item['provinceId'] == '5') {
                        //normal-อยุธยา
                        $productIdSize = [17958, 171314, 17959, 17960, 17961, 17962, 17963, 17964, 17965];
                    } elseif ($item['transportType'] == 'cod' && $item['zipcode'] == '13180' && $item['provinceId'] == '4') {
                        //cod-ปทุมธานี
                        $productIdSize = [17966, 171315, 17967, 17968, 17969, 17970, 17971, 17972, 17973];
                    } elseif ($item['transportType'] == 'cod' && $item['zipcode'] == '13180' && $item['provinceId'] == '5') {
                        //cod-อยุธยา
                        $productIdSize = [17974, 171316, 17975, 17976, 17977, 17978, 17979, 17980, 17981];
                    } elseif ($item['transportType'] == 'normal' && (intval($provinceId[0] . $provinceId[1]) >= 10 && intval($provinceId[0] . $provinceId[1]) < 14)) {
                        //normal bkk
                        $productIdSize = [17945, 171313, 17946, 17947, 17948, 17949, 17950, 17951, 17952];
                    } elseif ($item['transportType'] == 'normal' && intval($provinceId[0] . $provinceId[1]) > 14) {
                        //normal non-bkk
                        $productIdSize = [17958, 171314, 17959, 17960, 17961, 17962, 17963, 17964, 17965];
                    } elseif ($item['transportType'] == 'cod' && (intval($provinceId[0] . $provinceId[1]) >= 10 && intval($provinceId[0] . $provinceId[1]) < 14)) {
                        //cod bkk
                        $productIdSize = [17966, 171315, 17967, 17968, 17969, 17970, 17971, 17972, 17973];
                    } else {
                        //cod non-bkk
                        $productIdSize = [17974, 171316, 17975, 17976, 17977, 17978, 17979, 17980, 17981];
                    }

                    $lowerParcelSize = strtolower($item['parcelSize']);
                    if ($lowerParcelSize == 'miniplus') {
                        $parcelSize = 'mini+';
                    } elseif ($lowerParcelSize == 'splus') {
                        $parcelSize = 's+';
                    } elseif ($lowerParcelSize == 'mplus') {
                        $parcelSize = 'm+';
                    } else {
                        $parcelSize = $lowerParcelSize;
                    }

                    $parcelPriceSize = $repMerchantProduct->findParcelSizePrice($data['agentMerId'], $productIdSize, $parcelSize);
                    if ($parcelPriceSize == null) {
                        $output = array('status' => 'ERROR_NO_PRODUCT');
                    } else {
                        /*get new invoice*/
                        $em->beginTransaction();
                        $em->getConnection()->exec('LOCK TABLES merchant_billing_geninv WRITE;');
                        $output = $em->getConnection()->query("SELECT MAX(geninvoice) as maxId FROM merchant_billing_geninv WHERE takeorderby=" . $data['agentMerId']);
                        $maxId = json_decode($this->json($output)->getContent(), true);
                        $invId = 0;
                        if ($maxId) {
                            $invId = $maxId[0]["maxId"] + 1;
                        }
                        $newInvoice = new MerchantBillingGeninv();
                        $newInvoice->setDatestamp(new \DateTime("now", new \DateTimeZone('Asia/Bangkok')));
                        $newInvoice->setTakeorderby($data['agentMerId']);
                        $newInvoice->setGeninvoice($invId);
                        $em->persist($newInvoice);
                        $em->flush();
                        $em->getConnection()->exec('UNLOCK TABLES;');
                        ////////////////////////////////GEN NEW INVOICE/////////////////////////////////////////////////
//                        dd($invId);
                        $prefix = $repMerchantConfig->findBy(array('takeorderby' => $data['agentMerId']));
                        $padMaxId = str_pad($invId, 5, "0", STR_PAD_LEFT);
                        $paymentInvoice = $prefix[0]->getInvPrefix() . date("ymd") . $padMaxId;
                        ///////////////////////////////GEN RECORD ID////////////////////////////////////////////////////
                        $mtime = str_replace(".", "", microtime(true));
//            $keystring = _generateRandomString();
                        $keystring = random_bytes(10);
                        $keystring = sha1($keystring . uniqid(true) . md5(date("ymdHisU"))) . rand(111, 999) . $mtime;
                        $keystring = date("YmdHis") . $keystring . $data['agentMerId'] . $data['agentUserId'];
                        /////////////////////////////////INSERT MERCHANT BILLING DATA///////////////////////////////////
                        $merchantBilling = new MerchantBilling();
                        $merchantBilling->setTakeorderby($data['agentMerId']);
                        $merchantBilling->setAdminid($data['agentUserId']);
                        $merchantBilling->setPaymentInvoice($paymentInvoice);
                        $merchantBilling->setPaymentAmt($item['codValue']);
                        $merchantBilling->setPaymentDiscount($item['codValue']);
                        $merchantBilling->setTransportprice($parcelPriceSize[0]['productprice']);//ค่าส่ง
                        if ($item['transportType'] == 'normal') {
                            $merchantBilling->setPaymentStatus('00');
                            $merchantBilling->setPaymentdate(new \DateTime($dateToday, new \DateTimeZone('Asia/Bangkok')));
                            $merchantBilling->setPaycodeExpiredate(new \DateTime($dateExpire, new \DateTimeZone('Asia/Bangkok')));
                            $merchantBilling->setOrderstatus('103');
                            $merchantBilling->setPaymentMethod('99');
                        } else {
                            $merchantBilling->setPaymentStatus('02');
                            $merchantBilling->setPaymentdate(null);
                            $merchantBilling->setPaycodeExpiredate(null);
                            $merchantBilling->setOrderstatus('102');
                            $merchantBilling->setPaymentMethod('60');
                        }
                        $merchantBilling->setPaycode(null);
                        $merchantBilling->setOrderstatusDatetime(new \DateTime($dateToday, new \DateTimeZone('Asia/Bangkok')));
                        $merchantBilling->setOrderdate(new \DateTime($dateToday, new \DateTimeZone('Asia/Bangkok')));
                        $merchantBilling->setOrdertransport($item['transportType']);
                        $merchantBilling->setOrdername('');
                        $merchantBilling->setOrderaddr('');
                        $merchantBilling->setDistrict('');
                        $merchantBilling->setDistrictcode(0);
                        $merchantBilling->setAmphur('');
                        $merchantBilling->setAmphercode(0);
                        $merchantBilling->setProvince('');
                        $merchantBilling->setProvincecode('');
                        $merchantBilling->setGeoname('');
                        $merchantBilling->setGeoid(0);
                        $merchantBilling->setZipcode($item['zipcode']);
                        $merchantBilling->setOrderemail('-');
                        $merchantBilling->setOrderphoneno('66');
                        $merchantBilling->setOrdershortnote('');
                        $merchantBilling->setShortnoteupdateby(0);
                        $merchantBilling->setOrderremark('-');
                        $merchantBilling->setParcelRef($item['tracking']);
                        $merchantBilling->setParcelBillNo($parcelBillNo);
                        $merchantBilling->setParcelMemberId($data['senderMemberId']);
                        $merchantBilling->setBillingno(null);
                        $merchantBilling->setExtRecordId($keystring);
                        $merchantBilling->setPeakValue('');
                        $merchantBilling->setPeakInvId('');
                        $merchantBilling->setPeakInvoiceSend(0);
                        $merchantBilling->setPeakReceiptSend(0);
                        $merchantBilling->setPeakCodReceiptSend(0);
                        $merchantBilling->setPeakUrlInvoiceWebview('');
                        $merchantBilling->setPeakUrlReceiptWebview('');
                        $merchantBilling->setPeakUrlCodReceiptWebview(null);
                        $merchantBilling->setPeakError(null);
                        $merchantBilling->setPeakErrorTimestamp(null);
                        $merchantBilling->setRecordFrom("Parcel Agent Mobile App");

                        ///////////////////////////////////INSERT MERCHANT BILLING DETAIL DATA//////////////////////////////
                        $globalProduct = $repGlobalProduct->findBy(array('productid' => $parcelPriceSize[0]['pId']));
                        $parcelMember = $repParcelMember->findBy(array('memberId' => $data['senderMemberId']));
                        $globalProductImg = $repGlobalProductImg->findBy(array('productcode' => $parcelPriceSize[0]['pId']));

                        $merchantBillingDetail = new MerchantBillingDetail();
                        $merchantBillingDetail->setTakeorderby($data['agentMerId']);
                        $merchantBillingDetail->setPaymentInvoice($paymentInvoice);
                        $merchantBillingDetail->setProductid($parcelPriceSize[0]['mId']);
                        $merchantBillingDetail->setGlobalProductid($parcelPriceSize[0]['pId']);
                        $merchantBillingDetail->setProductname($parcelPriceSize[0]['productname']);
                        $merchantBillingDetail->setProductorder(1);
                        $merchantBillingDetail->setProductprice($item['codValue']);
                        $merchantBillingDetail->setProductcost($parcelPriceSize[0]['productcost']);
                        $merchantBillingDetail->setProductPoint(0);
                        $merchantBillingDetail->setProductCommission(0);
                        $merchantBillingDetail->setProductCommissionPercent(0);
                        $merchantBillingDetail->setDeliveryFeeMultiStep(null);
                        $merchantBillingDetail->setDeliveryFee($globalProduct[0]->getDeliveryFee());
                        $merchantBillingDetail->setDeliveryFeeInPrice($globalProduct[0]->getDeliveryFeeInPrice());
                        $merchantBillingDetail->setDeliveryFeeRatio($globalProduct[0]->getDeliveryFeeRatio());
                        if ($globalProductImg == null) {
                            $merchantBillingDetail->setImgproductonbill(null);
                        } else {
                            $merchantBillingDetail->setImgproductonbill($globalProductImg[0]->getThumbimg());
                        }
                        $merchantBillingDetail->setImgproductpathonbill(null);
                        $merchantBillingDetail->setNoteremark($data['senderMemberId'] . '-' . $parcelMember[0]->getAliasname() . '-' . $paymentInvoice);
                        $merchantBillingDetail->setCommissionset(null);
                        $merchantBillingDetail->setTimestamp(new \DateTime($dateToday, new \DateTimeZone('Asia/Bangkok')));
                        $merchantBillingDetail->setOwnerproduct(0);
                        $merchantBillingDetail->setOwnerBillNo('');
                        ///////////////////////////////////INSERT MERCHANT BILLING DELIVERY DATA////////////////////////////
                        $globalWarehouse = $repGlobalWarehouse->findBy(array('id' => $globalProduct[0]->getWarehouse()));
                        $merchantBillingDelivery = new MerchantBillingDelivery();
                        $merchantBillingDelivery->setTakeorderby($data['agentMerId']);
                        $merchantBillingDelivery->setPaymentInvoice($paymentInvoice);
                        $merchantBillingDelivery->setPaymentSubInvoice($data['agentMerId'] . '-' . $paymentInvoice . '-' . $globalProduct[0]->getWarehouse());
                        $merchantBillingDelivery->setCodPrice($item['codValue']);
                        $merchantBillingDelivery->setExpenseDiscount(0);
                        $merchantBillingDelivery->setGlobalWarehouse($globalWarehouse[0]->getWarehouseTier());
                        $merchantBillingDelivery->setWarehouseId($globalProduct[0]->getWarehouse());
                        $merchantBillingDelivery->setMailcode($item['tracking']);
                        $merchantBillingDelivery->setTransporterId(1);
                        $merchantBillingDelivery->setProductParcelSize(0);
                        $merchantBillingDelivery->setPrepareMailcode($item['tracking']);
                        ///////////////////////////////////INSERT FLAG TRACKING DATA////////////////////////////////////////
                        $checkParcelDrop = new CheckParcelDrop();
                        $checkParcelDrop->setMerId($data['agentMerId']);
                        $checkParcelDrop->setAgentUserId($data['agentUserId']);
                        $checkParcelDrop->setPaymentInvoice($paymentInvoice);
                        $checkParcelDrop->setParcelRef($item['tracking']);
                        $checkParcelDrop->setDateDrop(new \DateTime($dateToday, new \DateTimeZone('Asia/Bangkok')));
                        $checkParcelDrop->setStatus(0);

                        $em->persist($merchantBilling);
                        $em->persist($merchantBillingDetail);
                        $em->persist($merchantBillingDelivery);
                        $em->persist($checkParcelDrop);
                        $em->flush();

                        $output = array('status' => 'SUCCESS',
                            'orderDate' => $dateToday,
                            'parcelBillNo' => $parcelBillNo
                        );
                    }
                }
            }
        }

        return $this->json($output);
    }

    /**
     * @Route("/parcel/agent/receipt/api", methods={"POST"})
     */
    public function receiptParcelAgent(Request $request,
                                       EntityManagerInterface $em
    )
    {
        $data = json_decode($request->getContent(), true);
        $sumFee = 0;

        $query = "SELECT mb.parcel_ref as tracking,mb.orderdate as orderDate,mb.ordername as orderName,mDetail.productname as productName,mDetail.delivery_fee as deliveryFee " .
            "FROM merchant_billing mb " .
            "JOIN merchant_billing_detail mDetail " .
            "ON mb.takeorderby=mDetail.takeorderby AND mb.payment_invoice=mDetail.payment_invoice " .
            "WHERE mb.parcel_bill_no='" . $data['billNo'] . "'";
        $merchantInfo = $em->getConnection()->query($query);
        $merchantDetail = json_decode($this->json($merchantInfo)->getContent(), true);

        if ($merchantDetail == null) {
            $output = array("status" => "ERROR_NOT_FOUND_BILLING");
        } else {
            foreach ($merchantDetail as $item) {
                $sumFee += $item['deliveryFee'];
            }
            $output = array("status" => "SUCCESS",
                "receiptDetail" => $merchantDetail,
                "sumReceipt" => $sumFee
            );
        }
        return $this->json($output);
    }

    /**
     * @Route("/parcel/agent/list/receipt/agent/api", methods={"POST"})
     */
    public function listReceiptAgent(Request $request,
                                     MerchantBillingRepository $repMerchantBilling
    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);
        $listBillNo = $repMerchantBilling->findBillNo($data['startDate'], $data['endDate']);
        if ($listBillNo == null) {
            $output = ["status" => "ERROR_NOT_FOUND"];
        } else {
            $output = ["status" => "SUCCESS",
                "listBillNo" => $listBillNo
            ];
        }
        return $this->json($output);
    }

    /**
     * @Route("/parcel/agent/list/product/agent/api", methods={"POST"})
     */
    public function listProductAgentPost(Request $request,
                                         MerchantProductRepository $repMerchantProduct,
                                         PostinfoZipcodesRepository $repZipcode
    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);
        $districtCode = $repZipcode->findBy(array('zipcode' => $data['zipcode']));
        $provinceId = str_split($districtCode[0]->getDistrictCode());

        if ($data['transportType'] == 'normal' && $data['zipcode'] == '13180' && $data['provinceId'] == '4') {
            //normal-ปทุมธานี
            $productIdSize = [17945, 171313, 17946, 17947, 17948, 17949, 17950, 17951, 17952];
        } elseif ($data['transportType'] == 'normal' && $data['zipcode'] == '13180' && $data['provinceId'] == '5') {
            //normal-อยุธยา
            $productIdSize = [17958, 171314, 17959, 17960, 17961, 17962, 17963, 17964, 17965];
        } elseif ($data['transportType'] == 'cod' && $data['zipcode'] == '13180' && $data['provinceId'] == '4') {
            //cod-ปทุมธานี
            $productIdSize = [17966, 171315, 17967, 17968, 17969, 17970, 17971, 17972, 17973];
        } elseif ($data['transportType'] == 'cod' && $data['zipcode'] == '13180' && $data['provinceId'] == '5') {
            //cod-อยุธยา
            $productIdSize = [17974, 171316, 17975, 17976, 17977, 17978, 17979, 17980, 17981];
        } elseif ($data['transportType'] == 'normal' && (intval($provinceId[0] . $provinceId[1]) >= 10 && intval($provinceId[0] . $provinceId[1]) < 14)) {
            //normal bkk
            $productIdSize = [17945, 171313, 17946, 17947, 17948, 17949, 17950, 17951, 17952];
        } elseif ($data['transportType'] == 'normal' && intval($provinceId[0] . $provinceId[1]) > 14) {
            //normal non-bkk
            $productIdSize = [17958, 171314, 17959, 17960, 17961, 17962, 17963, 17964, 17965];
        } elseif ($data['transportType'] == 'cod' && (intval($provinceId[0] . $provinceId[1]) >= 10 && intval($provinceId[0] . $provinceId[1]) < 14)) {
            //cod bkk
            $productIdSize = [17966, 171315, 17967, 17968, 17969, 17970, 17971, 17972, 17973];
        } else {
            //cod non-bkk
            $productIdSize = [17974, 171316, 17975, 17976, 17977, 17978, 17979, 17980, 17981];
        }

        $parcelPriceSize = $repMerchantProduct->findParcelSizePrice($data['agentMerId'], $productIdSize, $data['parcelSize']);
        if ($parcelPriceSize == null) {
            $output = ["status" => "ERROR_NOT_FOUND"];
        } else {
            $output = ["status" => "SUCCESS",
                "productPrice" => $parcelPriceSize[0]['productprice']];
        }
        return $this->json($output);
    }

    ////////////////////////////////////////////////////Shop Drop Part//////////////////////////////////////////////////

    /**
     * @Route("/parcel/agent/shop/parcel/drop/api", methods={"POST"})
     */
    public function shopParcelDrop(Request $request,
                                   EntityManagerInterface $em,
                                   CheckParcelDropRepository $repCheckParcelDrop
    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);
        $date = new \DateTime($data['dateDrop']);
        $trackingWaitingShopScan = $repCheckParcelDrop->findRemainTracking($data['agentUserId'], $data['agentMerId'], $date);
        if (count($data['trackingList']) == 0) {
            $output = array("status" => "ERROR_NOT_TRACKING_LIST");
        } else {
            foreach ($data['trackingList'] as $tracking) {
                $checkParcelTracking = $repCheckParcelDrop->findOneBy(array('parcelRef' => $tracking['tracking'],
                    'merId' => $data['agentMerId']
                ));
                if ($checkParcelTracking == null) {
                    $trackingNotfound[] = ["tracking" => $tracking['tracking']];
                    $output = array("status" => "ERROR_NO_TRACKING", "trackingList" => $trackingNotfound);
                } else {
                    $checkParcelTracking->setDropMerId($data['shopMerId']);
                    $checkParcelTracking->setStatus(1);
                    $em->flush();
                    if ($trackingWaitingShopScan == null) {
                        $output = array("status" => "SUCCESS");
                    } else {
                        $output = array("status" => "ERROR_REMAIN_TRACKING",
                            "remainTracking" => $trackingWaitingShopScan
                        );
                    }
                }
            }
        }
        return $this->json($output);
    }

}
