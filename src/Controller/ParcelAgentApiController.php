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
        if ($data['phoneno'] == '') {
            $output = array('status' => "ERROR_DATA_NOT_COMPLETE");
        } else {
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
        if ($data['phoneno'] == '') {
            $output = array('status' => "ERROR_DATA_NOT_COMPLETE");
        } else {
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
            $resultIdCardCheck = $this->validatePID($data['citizenId']);
            if ($resultIdCardCheck == false) {
                $output = ['status' => 'ERROR_ID_CARD_WRONG'];
            } else {
                $pattern = '/^0\d{9}$/';
                $phoneNO = trim($data['phone']);
                if (!preg_match($pattern, $phoneNO)) {
                    $output = ['status' => 'ERROR_PHONE_WRONG_FORMAT'];
                } else {
                    $arr = str_split($phoneNO);
                    if (isset($arr[0]) && $arr[0] == '0') {
                        $phoneNO = '66';
                        $passCode = '';
                        for ($i = 1; $i < count($arr); $i++) {
                            $phoneNO .= $arr[$i];
                        }
                        for ($j = 6; $j < count($arr); $j++) {
                            $passCode .= $arr[$j];
                        }
                    }

                    $checkDuplicateParcelMember = $repParcelMember->count(array('phoneregis' => $phoneNO));
                    if ($checkDuplicateParcelMember > 0) {
                        $output = ['status' => 'ERROR_DUPLICATE_MEMBER'];
                    } else {
                        $countOnParcelMember = $repParcelMember->count(array('merid' => $data['merId']));

                        ///////////////////////////////////////All Info for Member Id///////////////////////////////////////////
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
                        ////////////////////////////////////////////////////////////////////////////////////////////////////////

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
                        $logImg->setSource($data['source']);
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
                        $parcelMember->setBankBranchCode($data['bankBranchCode']);
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
                }
            }
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

    ) {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);
        $parcelMemberInfo = $repParcelMember->findOneBy(array('phoneregis' => $data['phoneRegis']));

        if ($data['phoneRegis'] == '' || $data['bankAccName'] == '' || $data['bankIssue'] == '' || $data['bankAcc'] == '' || $data['imgBookBankUrl'] == '' ||$data['source']=='') {
            $output = array('status' => "ERROR_DATA_NOT_COMPLETE");
        } elseif ($parcelMemberInfo == null) {
            $output = ['status' => 'Error_No_Member_Info'];
        } else {
            $parcelMemberInfo->setRefAddress($data['address']);
            $parcelMemberInfo->setBankacc($data['bankAcc']);
            $parcelMemberInfo->setBankBranchCode($data['bankBranchCode']);
            $parcelMemberInfo->setBankAccName($data['bankAccName']);
            $parcelMemberInfo->setBankIssue($data['bankIssue']);

            $imgBankInfo = $repImgParcelAgent->findOneBy(array('memberId' => $parcelMemberInfo->getMemberId(),'source'=>$data['source']));

            if ($imgBankInfo == null) {
                $logImg = new LogImgParcelAgent();
                $logImg->setMemberId($parcelMemberInfo->getMemberId());
//                    $logImg->setImgUrlCitizen($data['imgUrl']);
                $logImg->setImgUrlBank($data['imgBookBankUrl']);
//                    $logImg->setRawDataRegister($request->getContent());
                $logImg->setRawDataBank($request->getContent());
                $logImg->setRecordDateBank(new \DateTime("now", new \DateTimeZone('Asia/Bangkok')));
                $logImg->setSource($data['source']);
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
    public
    function selectZipcodeThailand(Request $request,
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
    public
    function selectBankName(GlobalBankIssueRepository $repBankIssue)
    {
        $bankInfo = $repBankIssue->findBy(array('status' => 'active'));
        return $this->json($bankInfo);
    }

    ////////////////////////////////////////////////////Quick Link Part/////////////////////////////////////////////////

    /**
     * @Route("/parcel/agent/quicklink/api", methods={"POST"})
     */
    public
    function parcelAgentQuickLinkPost(Request $request,
                                      EntityManagerInterface $em,
                                      MerchantProductRepository $repMerchantProduct,
                                      MerchantConfigRepository $repMerchantConfig,
                                      PostinfoZipcodesRepository $repZipcode,
                                      GlobalProductRepository $repGlobalProduct,
                                      ParcelMemberRepository $repParcelMember,
                                      GlobalProductImageRepository $repGlobalProductImg,
                                      GlobalWarehouseRepository $repGlobalWarehouse,
                                      MerchantBillingRepository $repMerchantBilling
    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);
        $dateToday = date("Y-m-d H:i:s", strtotime("now"));
        $dateExpire = date("Y-m-d H:i:s", strtotime("now" . "+3 Days"));
        $tracks = [];
        $output = [];
        if($data['username'] =='' || $data['agentUserId']=='' || $data['agentMerId']=='' || $data['senderMemberId']=='' || $data['senderMerId']==''){
            file_put_contents('../log/logtest.txt', date("Y-m-d H:i:s").' ERROR_DATA_NOT_COMPLETE ', FILE_APPEND);
            $output = array('status' => "ERROR_DATA_NOT_COMPLETE");
            return $this->json($output);
        }else {
            $checkMerchantActive=$repMerchantConfig->findOneBy(['takeorderby'=>$data['agentMerId'],'status'=>'active']);
            if($checkMerchantActive== null ){
                file_put_contents('../log/logtest.txt', date("Y-m-d H:i:s").' ERROR_MER_ID_NOT_ACTIVE ', FILE_APPEND);
                $output = array('status' => 'ERROR_MER_ID_NOT_ACTIVE');
                return $this->json($output);
            } else {
                if ($data['agentMerId'] != $data['senderMerId']) {
                    file_put_contents('../log/logtest.txt', date("Y-m-d H:i:s").' ERROR_MER_ID_NOT_MATCH ', FILE_APPEND);
                    $output = array('status' => 'ERROR_MER_ID_NOT_MATCH');
                    return $this->json($output);
                } else {
                    $meet_require = true;
                    if (count($data['trackingList']) <= 0) {
                        file_put_contents('../log/logtest.txt', date("Y-m-d H:i:s").' ERROR_NO_TRACKING_LIST ', FILE_APPEND);
                        $output = array('status' => "ERROR_NO_TRACKING_LIST");
                        return $this->json($output);
                    } else {
                        foreach ($data['trackingList'] as $itemTracking) {
                            $patternTracking11 = '/^[T|t][D|d][Z|z]+[0-9]{8}?$/i';
                            $patternTracking12 = '/^[T|t][D|d][Z|z]+[0-9]{8}[A-Z]?$/i';
                            $tracking = trim($itemTracking['tracking']);

                            $newTrackingArr = str_split($tracking);

                            if ((count($newTrackingArr) == 11) && (!preg_match($patternTracking11, $tracking))) {
                                file_put_contents('../log/logtest.txt', date("Y-m-d H:i:s").' ERROR_TRACKING_WRONG_FORMAT ', FILE_APPEND);
                                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                                return $this->json($output);
                            } elseif ((count($newTrackingArr) == 12) && (!preg_match($patternTracking12, $tracking))) {
                                file_put_contents('../log/logtest.txt', date("Y-m-d H:i:s").' ERROR_TRACKING_WRONG_FORMAT ', FILE_APPEND);
                                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                                return $this->json($output);
                            } elseif (($itemTracking['transportType'] == 'cod') && ($itemTracking['codValue'] == 0)) {
                                file_put_contents('../log/logtest.txt', date("Y-m-d H:i:s").' ERROR_WRONG_COD_VALUE ', FILE_APPEND);
                                $output = array('status' => 'ERROR_WRONG_COD_VALUE');
                                return $this->json($output);
                            } else {
                                $tracks[] = $itemTracking['tracking'];
                            }
                        }

                        if (count($tracks) > 0) {
                            foreach ($tracks as $track) {
                                $checkParcelRef = $repMerchantBilling->count(array('parcelRef' => $track));
                                if ($checkParcelRef > 0) {
                                    $meet_require = false;
                                }
                            }
                        } else {
                            $meet_require = false;
                        }

                        if ($meet_require == false) {
                            file_put_contents('../log/logtest.txt', date("Y-m-d H:i:s").' ERROR_DUPLICATE_TRACKING ', FILE_APPEND);
                            $output = array('status' => 'ERROR_DUPLICATE_TRACKING');
                            return $this->json($output);

                        } else {
                            ///////////////////////////////////////////GEN PARCEL BILL NO///////////////////////////////////////////////
                            $parcelBillNo = $data['agentMerId'] . '-' . $data['agentUserId'] . '-' . date("ymdHis") . '-' . rand(111, 999);
                            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            foreach ($data['trackingList'] as $item) {
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
//                                    $merchantBillingDelivery->setWarehouseId($globalProduct[0]->getWarehouse());
                                    $merchantBillingDelivery->setWarehouseId(0);
                                    $merchantBillingDelivery->setMailcode($item['tracking']);
                                    $merchantBillingDelivery->setTransporterId(0);
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
                }
            }
        }
        return $this->json($output);
    }

    /**
     * @Route("/parcel/agent/receipt/api", methods={"POST"})
     */
    public
    function receiptParcelAgent(Request $request,
                                EntityManagerInterface $em
    )
    {
        $data = json_decode($request->getContent(), true);
        $sumFee = 0;
        if ($data['billNo'] == '') {
            $output = array("status" => "ERROR_DATA_NOT_COMPLETE");
        } else {
            $query = "SELECT mb.parcel_ref as tracking,mb.orderdate as orderDate,mb.ordername as orderName,mb.ordertransport as productType, mb.payment_amt as codValue, mDetail.productname as productName,mDetail.delivery_fee as deliveryFee " .
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
        }

        return $this->json($output);
    }

    /**
     * @Route("/parcel/agent/list/receipt/agent/api", methods={"POST"})
     */
    public
    function listReceiptAgent(Request $request,
                              MerchantBillingRepository $repMerchantBilling
    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);
        if ($data['startDate'] == '' || $data['endDate'] == '') {
            $output = ["status" => "ERROR_DATA_NOT_COMPLETE"];
        } else {
            $listBillNo = $repMerchantBilling->findBillNo($data['startDate'], $data['endDate']);
            if ($listBillNo == null) {
                $output = ["status" => "ERROR_NOT_FOUND"];
            } else {
                $output = ["status" => "SUCCESS",
                    "listBillNo" => $listBillNo
                ];
            }
        }
        return $this->json($output);
    }

    /**
     * @Route("/parcel/agent/product/price/agent/api", methods={"POST"})
     */
    public function listProductAgentPost(Request $request,
                                         MerchantProductRepository $repMerchantProduct,
                                         PostinfoZipcodesRepository $repZipcode
    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);
        if ($data['zipcode'] == '' || $data['parcelSize'] == '' || $data['transportType'] == '' || $data['agentMerId'] == '') {
            $output = ["status" => "ERROR_DATA_NOT_COMPLETE"];
        } else {
            $districtCode = $repZipcode->findBy(array('zipcode' => $data['zipcode']));
            $provinceId = str_split($districtCode[0]->getDistrictCode());

            $lowerParcelSize = strtolower($data['parcelSize']);
            if ($lowerParcelSize == 'miniplus') {
                $parcelSize = 'mini+';
            } elseif ($lowerParcelSize == 'splus') {
                $parcelSize = 's+';
            } elseif ($lowerParcelSize == 'mplus') {
                $parcelSize = 'm+';
            } else {
                $parcelSize = $lowerParcelSize;
            }

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

            $parcelPriceSize = $repMerchantProduct->findParcelSizePrice($data['agentMerId'], $productIdSize, $parcelSize);
            if ($parcelPriceSize == null) {
                $output = ["status" => "ERROR_NOT_FOUND"];
            } else {
                $output = ["status" => "SUCCESS",
                    "productPrice" => $parcelPriceSize[0]['productprice']];
            }
        }

        return $this->json($output);
    }

    ////////////////////////////////////////////////////Shop Drop Part//////////////////////////////////////////////

    /**
     * @Route("/parcel/agent/shop/parcel/drop/api", methods={"POST"})
     */
    public
    function shopParcelDrop(Request $request,
                            EntityManagerInterface $em,
                            CheckParcelDropRepository $repCheckParcelDrop
    )
    {
        date_default_timezone_set("Asia/Bangkok");
        $dateToday = date("Y-m-d", strtotime("now"));
        $data = json_decode($request->getContent(), true);
        if($data['dateDrop']=='' || $data['agentUserId']=='' || $data['agentMerId']=='' || $data['shopMerId']==''){
            $output = ["status" => "ERROR_DATA_NOT_COMPLETE"];
        } else {
            $date = new \DateTime($data['dateDrop']);
            $trackingWaitingShopScan = $repCheckParcelDrop->findRemainTracking($data['agentUserId'], $data['agentMerId'], $date);
            if (count($data['trackingList']) <= 0) {
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
                        $checkParcelTracking->setRecordDate(new \DateTime($dateToday, new \DateTimeZone('Asia/Bangkok')));
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
        }
        return $this->json($output);
    }

    public
    function validatePID($pid)
    {
        if (preg_match("/^(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)(\d)$/", $pid, $matches)) { //ใช้ preg_match
            if (strlen($pid) != 13) {
                $returncheck = false;
            } else {
                $rev = strrev($pid); // reverse string ขั้นที่ 0 เตรียมตัว
                $total = 0;
                for ($i = 1; $i < 13; $i++) { // ขั้นตอนที่ 1 - เอาเลข 12 หลักมา เขียนแยกหลักกันก่อน
                    $mul = $i + 1;
                    $count = $rev[$i] * $mul; // ขั้นตอนที่ 2 - เอาเลข 12 หลักนั้นมา คูณเข้ากับเลขประจำหลักของมัน
                    $total = $total + $count; // ขั้นตอนที่ 3 - เอาผลคูณทั้ง 12 ตัวมา บวกกันทั้งหมด
                }
                $mod = $total % 11; //ขั้นตอนที่ 4 - เอาเลขที่ได้จากขั้นตอนที่ 3 มา mod 11 (หารเอาเศษ)
                $sub = 11 - $mod; //ขั้นตอนที่ 5 - เอา 11 ตั้ง ลบออกด้วย เลขที่ได้จากขั้นตอนที่ 4
                $check_digit = $sub % 10; //ถ้าเกิด ลบแล้วได้ออกมาเป็นเลข 2 หลัก ให้เอาเลขในหลักหน่วยมาเป็น Check Digit
                if ($rev[0] == $check_digit) {  // ตรวจสอบ ค่าที่ได้ กับ เลขตัวสุดท้ายของ บัตรประจำตัวประชาชน
                    $returncheck = true; /// ถ้า ตรงกัน แสดงว่าถูก
                } else {
                    $returncheck = false; // ไม่ตรงกันแสดงว่าผิด
                }
            }
        } else {
            $returncheck = false;
        }
        return $returncheck;
    }

}
