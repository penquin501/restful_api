<?php

namespace App\Controller;

use App\Entity\CheckParcelDrop;
use App\Entity\MerchantBilling;
use App\Entity\MerchantBillingDelivery;
use App\Entity\MerchantBillingDetail;
use App\Entity\MerchantBillingGeninv;
use App\Repository\GlobalProductImageRepository;
use App\Repository\GlobalProductRepository;
use App\Repository\GlobalWarehouseRepository;
use App\Repository\MerchantBillingRepository;
use App\Repository\MerchantConfigRepository;
use App\Repository\MerchantProductRepository;
use App\Repository\ParcelMemberRepository;
use App\Repository\PostinfoZipcodesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ThaipostServiceController extends AbstractController
{
    /**
     * @Route("/thaipost/service/search/mailcode/api", methods={"GET"})
     */
    public function searchMailCode(Request $request ,EntityManagerInterface $em)
    {
        $sendMailDate = $request->query->get('sendMailDate');

//        $entityManager = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $query = "SELECT mailcode FROM merchant_billing_delivery WHERE transporter_id=99 AND Date(sendmaildate) = :sendMailDate";
        $listMailCode = $conn->prepare($query);
        $listMailCode->execute(array('sendMailDate' => $sendMailDate));
//        $listMailCode = $entityManager->getConnection()->query($sql);
//        $mailCode = json_decode($this->json($listMailCode)->getContent(), true);

        if ($listMailCode->rowCount() == 0) {
            $output = ['status' => 'ERROR_NOT_FOUND'];
        } else {
            $output = ['status' => 'SUCCESS', 'listMailCode' => $listMailCode];
        }

        return $this->json($output);
    }

    /**
     * @Route("/thaipost/product/price/api", methods={"POST"})
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

            if ($data['transportType'] == 'normal' && $data['zipcode'] == '13180') {
                //normal non-bkk
                $productIdSize = [17958, 171314, 17959, 17960, 17961, 17962, 17963, 17964, 17965];
            } elseif ($data['transportType'] == 'cod' && $data['zipcode'] == '13180') {
                //cod non-bkk
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

    /**
     * @Route("/thaipost/quicklink/api", methods={"POST"})
     */
    public function thaipostQuickLinkPost(Request $request,
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
        if ($data['username'] == '' || $data['agentUserId'] == '' || $data['agentMerId'] == '' || $data['senderMemberId'] == '' || $data['senderMerId'] == '' || count($data['trackingList'])==0) {
            $output = array('status' => "ERROR_DATA_NOT_COMPLETE");
            return $this->json($output);
        } else {
            $checkMerchantActive = $repMerchantConfig->findOneBy(['takeorderby' => $data['agentMerId'], 'status' => 'active']);
            if ($checkMerchantActive == null) {
                $output = array('status' => 'ERROR_MER_ID_NOT_ACTIVE');
                return $this->json($output);
            } else {
                if ($data['agentMerId'] != $data['senderMerId']) {
                    $output = array('status' => 'ERROR_MER_ID_NOT_MATCH');
                    return $this->json($output);
                } else {
                    $meet_require = true;
                    if (count($data['trackingList']) <= 0) {
                        $output = array('status' => "ERROR_NO_TRACKING_LIST");
                        return $this->json($output);
                    } else {
                        foreach ($data['trackingList'] as $itemTracking) {
                            $patternTracking11 = '/^[T|t][D|d][Z|z]+[0-9]{8}?$/i';
                            $patternTracking12 = '/^[T|t][D|d][Z|z]+[0-9]{8}[A-Z]?$/i';
                            $pattern = '/^0\d{9}$/';

                            $phoneNO = trim($itemTracking['orderPhone']);
                            $tracking = trim($itemTracking['tracking']);

                            $newTrackingArr = str_split($tracking);

                            if ((count($newTrackingArr) == 11) && (!preg_match($patternTracking11, $tracking))) {
                                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                                return $this->json($output);
                            } elseif ((count($newTrackingArr) == 12) && (!preg_match($patternTracking12, $tracking))) {
                                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                                return $this->json($output);
                            } elseif (($itemTracking['transportType'] == 'cod') && ($itemTracking['codValue'] == 0)) {
                                $output = array('status' => 'ERROR_WRONG_COD_VALUE');
                                return $this->json($output);
                            } elseif ($itemTracking['orderPhone'] == '') {
                                $output = array('status' => 'ERROR_NO_RECEIVER_PHONE');
                                return $this->json($output);
                            } elseif (!preg_match($pattern, $phoneNO)) {
                                $output = ['status' => 'ERROR_PHONE_WRONG_FORMAT'];
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
                            $output = array('status' => 'ERROR_DUPLICATE_TRACKING');
                            return $this->json($output);

                        } else {
                            ///////////////////////////////////////////GEN PARCEL BILL NO///////////////////////////////////////////////
                            $parcelBillNo = $data['agentMerId'] . '-' . $data['agentUserId'] . '-' . date("ymdHis") . '-' . rand(111, 999);
                            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            foreach ($data['trackingList'] as $item) {
                                $phoneNo = trim($item['orderPhone']);
                                $arr = str_split($phoneNo);
                                if (isset($arr[0]) && $arr[0] == '0') {
                                    $phoneNo = '66';
                                    for ($i = 1; $i < count($arr); $i++) {
                                        $phoneNo .= $arr[$i];
                                    }
                                }
                                //////////////////////////////////////GEN TRANSPORT PRICE///////////////////////////////////////////////
                                $districtCode = $repZipcode->findBy(array('zipcode' => $item['zipcode']));
                                $provinceId = str_split($districtCode[0]->getDistrictCode());

                                if ($item['transportType'] == 'normal' && $item['zipcode'] == '13180') {
                                    //normal non-bkk
                                    $productIdSize = [17958, 171314, 17959, 17960, 17961, 17962, 17963, 17964, 17965];
                                } elseif ($item['transportType'] == 'cod' && $item['zipcode'] == '13180') {
                                    //cod non-bkk
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
                                    $merchantBilling->setOrderphoneno($phoneNo);
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
}
