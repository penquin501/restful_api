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

class AfaController extends AbstractController
{
    /**
     * @Route("/afa/register/api", methods={"POST"})
     */
    public function afaRegister(Request $request,
                                EntityManagerInterface $em,
                                GlobalAuthenRepository $repGlobelAuthen,
                                LogImgParcelAgentRepository $repImgParcel
    ){
        date_default_timezone_set("Asia/Bangkok");
        $data = json_decode($request->getContent(), true);

        if ($data['phone'] == '' || $data['firstName'] == '' || $data['lastName'] == '' || $data['idCard'] == '') {
            $output = ['status' => 'ERROR_DATA_NOT_COMPLETE'];
        } else {
            $patternId = '/^([1-9]{1})\d{12}$/';
            $idCard = trim($data['idCard']);
            $arrIdCard = str_split($idCard);
            if((count($arrIdCard) < 0  && count($arrIdCard)>13) || !preg_match($patternId,$idCard)) {
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
                    if ($checkPhone > 0) {
                        $output = ['status' => 'ERROR_DUPLICATED_PHONE'];
                    } elseif($data['merId']!= 188) {
                        $output = ['status' => 'ERROR_WRONG_MER_ID'];
                    } else {
                        $newImgCitizenId= new LogImgParcelAgent();
                        $newImgCitizenId->setMemberId($data['idCard']);
                        $newImgCitizenId->setImgUrlCitizen($data['imgUpload']);
                        $newImgCitizenId->setRawDataRegister($request->getContent());
                        $newImgCitizenId->setRecordDateRegister(new \DateTime("now", new \DateTimeZone('Asia/Bangkok')));
                        $newImgCitizenId->setSource('afa_register');

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
                        $newUser->setIdcard($data['idCard']);
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
}
