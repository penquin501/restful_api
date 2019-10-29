<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\GlobalAuthen;
use App\Entity\LogImgParcelAgent;

use App\Repository\GlobalAuthenRepository;
use App\Repository\LogImgParcelAgentRepository;
use App\Repository\MerchantConfigRepository;

class AfaController extends AbstractController
{
    /**
     * @Route("/afa/register/api", methods={"POST"})
     */
    public function afaRegister(Request $request,
                                EntityManagerInterface $em,
                                GlobalAuthenRepository $repGlobelAuthen,
                                MerchantConfigRepository $repMerchantConfig
    ){
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);

        if ($data['merId'] == '' || $data['phone'] == '' || $data['firstName'] == '' || $data['lastName'] == '' || $data['citizenId'] == '') {
            $output = ['status' => 'ERROR_DATA_NOT_COMPLETE'];
        } else {
            $resultIdCardCheck=$this->validatePID($data['citizenId']);

            if($resultIdCardCheck==false){
                $output = ['status' => 'ERROR_ID_CARD_WRONG'];
            } elseif ($data['phone'][0] . $data['phone'][1] != '06' && $data['phone'][0] . $data['phone'][1] != '08' && $data['phone'][0] . $data['phone'][1] != '09') {
                $output = ['status' => 'ERROR_PHONE_WRONG_FORMAT'];
            } else {
                $pattern = '/^0\d{9}$/';
                $phoneNO = trim($data['phone']);
                if (!preg_match($pattern, $phoneNO)) {
                    $output = ['status' => 'ERROR_PHONE_WRONG_FORMAT'];
                } else {
                    ////////////////////////////////////////////////////////////////////////////////////////////////////
                    $arr = str_split($phoneNO);
                    if (isset($arr[0]) && $arr[0] == '0') {
                        $phoneNO = '66';
                        for ($i = 1; $i < count($arr); $i++) {
                            $phoneNO .= $arr[$i];
                        }
                    }
                    ////////////////////////////////////////////////////////////////////////////////////////////////////
                    $checkPhone = $repGlobelAuthen->count(array('phoneno' => $phoneNO));
                    $checkMerchant=$repMerchantConfig->count(array('takeorderby' => $data['merId']));
                    if ($checkPhone > 0) {
                        $output = ['status' => 'ERROR_DUPLICATED_PHONE'];
                    } elseif($checkMerchant<=0) {
                        $output = ['status' => 'ERROR_WRONG_MER_ID'];
                    } else {
                        $newImgCitizenId= new LogImgParcelAgent();
                        $newImgCitizenId->setMemberId($data['citizenId']);
                        $newImgCitizenId->setImgUrlCitizen($data['imgCitizenIdUrl']);
                        $newImgCitizenId->setImgUrlBank($data['imgBookBankUrl']);
                        $newImgCitizenId->setRawDataRegister($request->getContent());
                        $newImgCitizenId->setRecordDateRegister(new \DateTime("now", new \DateTimeZone('Asia/Bangkok')));
                        $newImgCitizenId->setSource($data['source']);

                        $newUser = new GlobalAuthen();
                        $newUser->setAfaUser('no');
                        $newUser->setAfaLevel('agent');
                        $newUser->setAfaRank('');
                        $newUser->setRefUserId(0);
                        $newUser->setMerid($data['merId']);
                        $newUser->setUname($data['firstName'] . "." . $data['lastName'][0]);
                        $newUser->setPwrd('');
                        $newUser->setFname($data['firstName'] . " " . $data['lastName']);
                        $newUser->setPhoneno($phoneNO);
                        $newUser->setIdcard($data['citizenId']);
                        $newUser->setAuthenlevel('user');
                        $newUser->setPermission(null);
                        $newUser->setLang('th');
                        $newUser->setStatus('pending');

                        $em->persist($newImgCitizenId);
                        $em->persist($newUser);
                        $em->flush();
                        $output = ['status' => 'SUCCESS'];
                    }
                }
            }
        }
        return $this->json($output);
    }

    /**
     * @Route("/afa/merchant/name/api", methods={"GET"})
     */
    public function selectMerchantName(Request $request,
                                       MerchantConfigRepository $repMerchantConfig
    ) {
        $listMerchant=$repMerchantConfig->findMerchantName();
        return $this->json(['listMerchantName'=>$listMerchant]);
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
