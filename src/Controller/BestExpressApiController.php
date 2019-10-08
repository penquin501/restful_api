<?php

namespace App\Controller;

use App\Entity\LogDataBestApi;
use App\Repository\LogDataBestApiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class BestExpressApiController extends AbstractController
{
    /**
     * @Route("/best/express/request/waybill/api", methods={"POST"})
     * @throws TransportExceptionInterface
     */
    public function requestWaybillBestApi(Request $request,LogDataBestApiRepository $repLogDataBest)
    {
        $client = HttpClient::create();
        $dataPost = json_decode($request->getContent(), true);

        $checkLogData=$repLogDataBest->count(array('trackingNo'=>$dataPost['mailCode'],'result'=>'success'));

        if($dataPost['mailCode']=='') {
            $output = ['status' => 'error_no_mail_code'];
        } elseif($checkLogData >= 1) {
            $output = ['status' => 'error_duplicate_mail_code'];
        } else {

            $bizData = [
                "auth" => [
                    "username" => "PT1016",
                    "pass" => "NeGoyzbD6cnA"
                ],
                "customerName" => "my945.me",
                "txLogisticID" => $dataPost['mailCode'],
                "serviceType" => "1",
                "orderFlag" => "1",
                "sendStartTime" => date("Y-m-d H:i:s"),
                "sendEndTime" => date("Y-m-d H:i:s", strtotime('+3 days')),
                "recSite" => "000001",
                "goodsValue" => 0.0,
                "itemsValue" => floatval($dataPost['codValue']),
                "insuranceValue" => 0.0,
                "bankCardOwner" => "บริษัท 945 โฮลดิ้ง จำกัด",
                "bankCode" => "014",
                "bankCardNo" => "4060562321",
                "specialCode" => "9",
                "sender" => [
                    "name" => "my945.me",
                    "mobile" => "029044877",
                    "postCode" => "12130",
                    "prov" => "ปทุมธานี",
                    "city" => "ลำลูกกา",
                    "email" => "cs@945holding.com",
                    "county" => "คูคต",
                    "address" => "945 ม.5 ถนนเสมาฟ้าคราม ซอย 20ข.",
                    "country" => "TH"
                ],
                "receiver" => [
                    "name" => $dataPost['orderName'],
                    "mobile" => $dataPost['orderPhoneNO'],
                    "postCode" => $dataPost['orderPostalCode'],
                    "prov" => $dataPost['orderProvince'],
                    "city" => $dataPost['orderCity'],
                    "email" => "cs@945holding.com",
                    "county" => $dataPost['orderDistrict'],
                    "address" => $dataPost['orderAddress'],
                    "country" => "TH"
                ],
                "items" => [
                    "item" => [
                        "itemName" => "พัสดุสินค้าสำคัญ",
                        "number" => "1"
                    ]
                ],
                'itemWeight' => 1
            ];
            $data = json_encode($bizData);

            $sign = md5($data . '945holding12345');
            $response = $client->request('POST', 'http://sgp-kdedi-test.800best.com/kd/api/process', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'body' => [
                    'serviceType' => 'KD_CREATE_WAYBILL_ORDER_NOTIFY',
                    'partnerID' => '945holding',
                    'partnerKey' => '945holding12345',
                    'sign' => $sign,
                    'bizData' => $data
                ],
            ]);
            try {
                $content = json_decode($response->getContent(), true);
                if ($content['result'] != true) {
                    $dataRequest = new LogDataBestApi();
                    $dataRequest->setRecordDate(new \DateTime("now", new \DateTimeZone('Asia/Bangkok')));
                    $dataRequest->setTrackingNo($dataPost['mailCode']);
                    $dataRequest->setRawDataRequest($request->getContent());
                    $dataRequest->setRawDataResponse($response->getContent());
                    $dataRequest->setResult($content['errorCode']);

                    $output = ['status' => 'error',
                        'mailNo' => $dataPost['mailCode'],
                        'errorCode' => $content['errorCode'],
                        'errorDescription' => $content['errorDescription']
                    ];
                } else {
                    if ($content['txLogisticID'] != $dataPost['mailCode']) {

                        $dataRequest = new LogDataBestApi();
                        $dataRequest->setRecordDate(new \DateTime("now", new \DateTimeZone('Asia/Bangkok')));
                        $dataRequest->setTrackingNo($dataPost['mailCode']);
                        $dataRequest->setRawDataRequest($request->getContent());
                        $dataRequest->setBestWaybill($content['mailNo']);
                        $dataRequest->setRawDataResponse($response->getContent());
                        $dataRequest->setResult('error_mail_code_not_match');

                        $output = ['status' => 'error_mail_code_not_match',
                            'txLogisticID' => $content['txLogisticID'],
                            'mailNo' => $content['mailNo'],
                        ];
                    } else {
                        $dataRequest = new LogDataBestApi();
                        $dataRequest->setRecordDate(new \DateTime("now", new \DateTimeZone('Asia/Bangkok')));
                        $dataRequest->setTrackingNo($dataPost['mailCode']);
                        $dataRequest->setRawDataRequest($request->getContent());
                        $dataRequest->setBestWaybill($content['mailNo']);
                        $dataRequest->setRawDataResponse($response->getContent());
                        $dataRequest->setResult('success');

                        $output = ['status' => 'success',
                            'txLogisticID' => $content['txLogisticID'],
                            'mailNo' => $content['mailNo'],
                        ];
                    }
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($dataRequest);
                $em->flush();

            } catch (TransportExceptionInterface $e) {
            }
        }
        return $this->json($output);
    }
}
