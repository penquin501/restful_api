<?php

namespace App\Controller;

use App\Entity\LogMerchantChangestatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\MerchantBillingRepository;
use App\Repository\MerchantBillingDeliveryRepository;

class DeliverApiController extends AbstractController
{
    /**
     * @Route("/deliver/check/receiver/info/api", methods={"GET"})
     */
    public function checkReceiverInfo(Request $request,
                                      MerchantBillingRepository $repMerchantBilling,
                                      MerchantBillingDeliveryRepository $repMerchantDelivery
    ) {
        $getTracking = $request->query->get('tracking');

        $patternTracking11 = '/^[T|t][D|d][Z|z]+[0-9]{8}?$/i';
        $patternTracking12 = '/^[T|t][D|d][Z|z]+[0-9]{8}[A-Z]?$/i';

        if ($getTracking == '') {
            $output = ["status" => "ERROR_DATA_NOT_COMPLETE"];
        } else {
            $tracking = trim($getTracking);
            $newTrackingArr = str_split($tracking);
            if ((count($newTrackingArr) == 11) && (!preg_match($patternTracking11, $tracking))) {
                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                return $this->json($output);
            } elseif ((count($newTrackingArr) == 12) && (!preg_match($patternTracking12, $tracking))) {
                $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                return $this->json($output);
            } else {
                $checkCodValue=$repMerchantDelivery->findOneBy(array('mailcode' => $tracking));
                if ($checkCodValue == null) {
                    $output = array('status' => 'ERROR_MAILCODE_NOT_FOUND');
                } else {
                    $checkReceiverInfo = $repMerchantBilling->findOneBy(array('takeorderby' => $checkCodValue->getTakeorderby(),'paymentInvoice'=>$checkCodValue->getPaymentInvoice()));
                    if($checkReceiverInfo==null){
                        $output = array('status' => 'ERROR_TRACKING_NOT_FOUND');
                    } else{
                        $output = [
                            'orderName' => $checkReceiverInfo->getOrdername(),
                            'orderAddress' => $checkReceiverInfo->getOrderaddr() . " ตำบล " . $checkReceiverInfo->getDistrict() . " อำเภอ " . $checkReceiverInfo->getAmphur() . " จังหวัด " . $checkReceiverInfo->getProvince() . " " . $checkReceiverInfo->getZipcode(),
                            'orderPhone' => $checkReceiverInfo->getOrderphoneno(),
                            'orderTransport' => $checkReceiverInfo->getOrdertransport(),
                            'codValue'=>intval($checkCodValue->getCodPrice())+intval($checkCodValue->getExpenseDiscount()),
                            'orderStatus' => $checkReceiverInfo->getOrderstatus()
                        ];
                    }

                }
            }
        }
        return $this->json($output);
    }

    /**
     * @Route("/deliver/list/daily/box/api", methods={"POST"})
     */
    public function listDailyBoxes(Request $request,EntityManagerInterface $em)
    {
        date_default_timezone_set("Asia/Bangkok");

        $dateToday = date("Y-m-d", strtotime("now"));
        $datePrevious = date("Y-m-d", strtotime("now" . "-3 month"));

        $data = json_decode($request->getContent(), true);

        if ($data['operator'] == '') {
            $output = ["status" => "ERROR_DATA_NOT_COMPLETE"];
        } else {
            $conn = $em->getConnection();
            $query = "SELECT count(tracking_no) as cTracking, tracking_datestamp as intervalDate FROM counter_data " .
                "WHERE operator=:operator AND tracking_datestamp > :datePrevious AND tracking_datestamp <= :dateToday " .
                "GROUP BY tracking_datestamp ORDER BY tracking_datestamp DESC";
            $queryListDateBoxes = $conn->prepare($query);
            $queryListDateBoxes->execute(array('operator' => $data['operator'],
                'datePrevious'=>$datePrevious,
                'dateToday'=>$dateToday));

            if ($queryListDateBoxes->rowCount() == 0) {
                $output = ["status" => "ERROR_NOT_FOUND"];
            } else {
                $output = ["status" => "SUCCESS",
                    "listDateBoxes" => $queryListDateBoxes
                ];
            }
        }
        return $this->json($output);
    }

    /**
     * @Route("/deliver/list/tracking/api", methods={"POST"})
     */
    public function listTracking(Request $request, EntityManagerInterface $em)
    {
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);

        if ($data['operator'] == '' || $data['date'] == '') {
            $output = ["status" => "ERROR_DATA_NOT_COMPLETE"];
        } else {
            $conn = $em->getConnection();
            $query = "SELECT tracking_no as trackingNo FROM counter_data WHERE operator=:operator AND tracking_datestamp =:dateTracking";
            $queryListTracking = $conn->prepare($query);
            $queryListTracking->execute(array('operator' => $data['operator'],
                'dateTracking'=>$data['date']));
            if ($queryListTracking->rowCount() == 0) {
                $output = ["status" => "ERROR_NOT_FOUND"];
            } else {
                $output = ["status" => "SUCCESS",
                    "listTracking" => $queryListTracking
                ];
            }
        }
        return $this->json($output);
    }

    /**
     * @Route("/deliver/save/data/api", methods={"POST"})
     */
    public function saveCounterData(Request $request,
                                    EntityManagerInterface $em,
                                    MerchantBillingRepository $repMerchantBilling,
                                    MerchantBillingDeliveryRepository $repMerchantBillingDelivery
    ) {
        date_default_timezone_set("Asia/Bangkok");

        $output = [];
        $tracks = [];
        $patternTracking11 = '/^[T|t][D|d][Z|z]+[0-9]{8}?$/i';
        $patternTracking12 = '/^[T|t][D|d][Z|z]+[0-9]{8}[A-Z]?$/i';
        $patternUrl='%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu';

        $data = json_decode($request->getContent(), true);

        if ($data['merId'] == '' || $data['userId'] == '' || $data['transporter'] == '' || $data['operator'] == '' || $data['signature'] == '' || $data['trackingTimestamp'] == '' || $data['location']=='') {
            $output = ["status" => "ERROR_DATA_NOT_COMPLETE"];
            return $this->json($output);
        } else if(!preg_match($patternUrl, $data['signature'])) {
            $output = ["status" => "ERROR_NO_SIGNATURE_LINK"];
            return $this->json($output);
        } else if(count($data['trackingList'])<=0){
            $output = ["status" => "ERROR_NO_TRACKING_LIST"];
            return $this->json($output);
        } else {

            foreach($data['trackingList'] as $tracking){
                $trackingStr = trim($tracking['tracking']);
                $newTrackingArr = str_split($trackingStr);
                if ((count($newTrackingArr) == 11) && (!preg_match($patternTracking11, $trackingStr))) {
                    $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                    return $this->json($output);
                } elseif ((count($newTrackingArr) == 12) && (!preg_match($patternTracking12, $trackingStr))) {
                    $output = array('status' => 'ERROR_TRACKING_WRONG_FORMAT');
                    return $this->json($output);
                } else {
                    $tracks[] = $tracking['tracking'];
                }
            }

            $meet_require = true;
            if (count($tracks) > 0) {
                foreach ($tracks as $track) {
                    $checkBillingInfo = $repMerchantBilling->findOneBy(array('parcelRef' => $track));
                    if ($checkBillingInfo==null) {
                        $meet_require = false;
                    }
                }
            } else {
                $meet_require = false;
            }

            if($meet_require==false) {
                $output = ["status" => "ERROR_NO_DATA_BILLING"];
                return $this->json($output);
            } else {
                $trackingDateStamp=date("Y-m-d", strtotime($data['trackingTimestamp']));

                $exLocation=(explode(",",$data['location']));
                $lat=$exLocation[0];//latitude
                $lng=$exLocation[1];//longitude

                foreach($data['trackingList'] as $item){
                    $randomStr=$this->generateId($data['transporter'],$item['tracking'],$data['licensePlate'],$data['operator'],$em);

                    $newCounterData="INSERT INTO counter_data(id,mer_id,user_id,tracking_no,transporter,license_plate,operator,signature,scan_date,scan_time,location_lat,location_lng,tracking_datestamp,tracking_timestamp) ".
                        "VALUES ('".$randomStr."','".$data['merId']."','".$data['userId']."','".$item['tracking']."','".$data['transporter']."','".$data['licensePlate']."','".$data['operator']."','".$data['signature']."',null,null,'".$lat."','".$lng."','".$trackingDateStamp."','".$data['trackingTimestamp']."')";
                    $em->getConnection()->query($newCounterData);
                    
                    $checkBillingPaymentMethod = $repMerchantBilling->findOneBy(array('parcelRef' => $item['tracking']));
                    if($checkBillingPaymentMethod->getPaymentMethod()=='60'){
                        $checkBillingPaymentMethod->setPaymentStatus('00');
                        $checkBillingPaymentMethod->setPaymentdate(new \DateTime($data['trackingTimestamp'], new \DateTimeZone('Asia/Bangkok')));
                        $checkBillingPaymentMethod->setOrderstatusDatetime(new \DateTime($data['trackingTimestamp'], new \DateTimeZone('Asia/Bangkok')));
                        $checkBillingPaymentMethod->setOrderstatus('105');
                    } else {
                        $checkBillingPaymentMethod->setOrderstatusDatetime(new \DateTime($data['trackingTimestamp'], new \DateTimeZone('Asia/Bangkok')));
                        $checkBillingPaymentMethod->setOrderstatus('105');
                    }
                    $checkBillingDeliveryInfo = $repMerchantBillingDelivery->findOneBy(array('mailcode' => $item['tracking']));
                    $checkBillingDeliveryInfo->setTransporterId(100);
                    $checkBillingDeliveryInfo->setTranstatus('S');
                    $checkBillingDeliveryInfo->setTransactiondate(new \DateTime($data['trackingTimestamp'], new \DateTimeZone('Asia/Bangkok')));
                    $checkBillingDeliveryInfo->setRemark('Updated By Lalarun');

                    $logMerchantStatus=new LogMerchantChangestatus();
                    $logMerchantStatus->setTakeorderby($data['merId']);
                    $logMerchantStatus->setUsersign($data['userId']);
                    $logMerchantStatus->setPaymentInvoice($checkBillingPaymentMethod->getPaymentInvoice());
                    $logMerchantStatus->setPreviousorderstatus($checkBillingPaymentMethod->getOrderstatus());
                    $logMerchantStatus->setCurrentorderstatus('105');
                    $logMerchantStatus->setTimetochange(new \DateTime("now", new \DateTimeZone('Asia/Bangkok')));
                    $logMerchantStatus->setChangefrommodule('Updated By Lalarun');

                    $em->persist($checkBillingPaymentMethod);
                    $em->persist($checkBillingDeliveryInfo);
                    $em->persist($logMerchantStatus);
                    $em->flush();
                }
                $output = ["status" => "SUCCESS"];
            }
        }
        return $this->json($output);
    }

    public function generateId($transporter,$trackingNo,$licensePlate,$operator,$em) {
        $mtime = str_replace(".","",microtime(true));
        $keystring = $this->generateRandomString();
        $keystring = sha1($keystring.uniqid(true).md5(date("ymdHisU").rand(11111,99999))).$transporter.$trackingNo.$licensePlate.$operator.md5($keystring.$operator.uniqid(true).sha1(date("ymdHisU").microtime(true).rand(11111,99999))).uniqid(true);
        $keystring = date("ymdHis").$mtime.$keystring;

        while($this->isUniqueID($keystring,$em)){ //if string is unique, while loop stops.
            $keystring = $this->generateRandomString();
            $keystring = sha1($keystring.uniqid(true).md5(date("ymdHisU").rand(11111,99999).rand(111,999))).$transporter.$trackingNo.$licensePlate.$operator.md5($keystring.$operator.$trackingNo.uniqid(true).sha1(date("ymdHisU").microtime(true).rand(11111,99999))).uniqid(true);
            $keystring = date("ymdHis").$mtime.$keystring;
        }
        unset($mtime);
        return $keystring;
    }

    public function generateRandomString() {
        $chars = array_merge(range('a', 'z'), range(0, 9));
        shuffle($chars);
        return implode(array_slice($chars, 0,25));
    }

    private function isUniqueID($string,$em) {
        $conn = $em->getConnection();
        $query = "SELECT id FROM counter_data WHERE id = :id";
//        $checkId = $em->getConnection()->query($query);
        $checkId = $conn->prepare($query);
        $checkId->execute(array('id' => $string));
//        $id = json_decode($this->json($checkId)->getContent(), true);

        if($checkId->rowCount() == 0) {
            $return = false;
        } else {
            $return = true;
        }

        return $return;
    }


}
