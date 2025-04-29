<?php


namespace YousignClientV3;


class Client
{


    /**
     * @var string
     */
    private $apikey;
    /**
     * @var string
     */
    private $apiBaseUrl;
    /**
     * @var string
     */
    private $apiBaseUrlWslash;
    /**
     * @var string
     */
    private $idfile;
    /**
     * @var string
     */
    private $idAdvProc;
    /**
     * @var array
     */
    private $member;
    /**
     * @var array
     */
    private $fileobject;
    /**
     * @var string
     */
    private $signatureRequestId;
    /**
     * @var array
     */
    private $signatureRequest;
    /**
     * @var array
     */
    private $documentUploadResponse;
    /**
     * @var string
     */
    public $documentId;
    /**
     * @var array
     */
    private $addSignerResponse;

    /**
     * @var array
     */
    private $ActivateSignatureResponse;
    /**
     * @var mixed
     */
    private $AddWebHookResponse;

    private $signerData;

    private $memberId;

    private $memberList;
    /**
     * @var mixed
     */
    private $signLink;

    /**
     * @var string
     */
    private $pdfBaseDir;



    /**
     * YousignClientV3 constructor.
     * @param $apikey
     * @param $mode
     */
    public function __construct($apikey,$mode)
    {
        // chemin absolut du répertoire du fichier pdf à signer pour les procédures avancés :
        $this->pdfBaseDir = '/home/web/pdftemp/';

        $this->setApikey($apikey);
        if ($mode == 'prod'){
            $this->apiBaseUrl = 'https://api.yousign.app/v3/';
            $this->apiBaseUrlWslash = 'https://api.yousign.app/v3';
        } else {
            // https://api-sandbox.yousign.app/v3/webhooks
            $this->apiBaseUrl = 'https://api-sandbox.yousign.app/v3/';
            $this->apiBaseUrlWslash = 'https://api-sandbox.yousign.app/v3';
        }

    }

    public static function world()
    {
        return "Client pour l'api Yousign V3";
    }


    /**
     *  les get et set génériques
     */

    /**
     * @return string
     */
    public function getPdfBaseDir()
    {
        return $this->pdfBaseDir;
    }

    /**
     * @param string $pdfBaseDir
     * @return YousignClientV3\Client
     */
    public function setPdfBaseDir(string $pdfBaseDir)
    {
        $this->pdfBaseDir = $pdfBaseDir;
        return $this;
    }


    /**
     * @return array
     */
    public function getSignatureRequest(): array
    {
        return $this->signatureRequest;
    }

    /**
     * @param array $signatureRequest
     * @return YousignClientV3\Client
     */
    public function setSignatureRequest(array $signatureRequest): Client
    {
        $this->signatureRequest = $signatureRequest;
        return $this;
    }

    /**
     * @return string
     */
    public function getApikey(): string
    {
        return $this->apikey;
    }

    /**
     * @param string $apikey
     * @return YousignClientV3\Client
     */
    public function setApikey(string $apikey): Client
    {
        $this->apikey = $apikey;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiBaseUrl(): string
    {
        return $this->apiBaseUrl;
    }

    /**
     * @param string $apiBaseUrl
     * @return YousignClientV3\Client
     */
    public function setApiBaseUrl(string $apiBaseUrl): Client
    {
        $this->apiBaseUrl = $apiBaseUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiBaseUrlWslash(): string
    {
        return $this->apiBaseUrlWslash;
    }

    /**
     * @param string $apiBaseUrlWslash
     * @return YousignClientV3\Client
     */
    public function setApiBaseUrlWslash(string $apiBaseUrlWslash): Client
    {
        $this->apiBaseUrlWslash = $apiBaseUrlWslash;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdfile(): string
    {
        return $this->idfile;
    }

    /**
     * @param string $idfile
     * @return YousignClientV3\Client
     */
    public function setIdfile(string $idfile): Client
    {
        $this->idfile = $idfile;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdAdvProc(): string
    {
        return $this->idAdvProc;
    }

    /**
     * @param string $idAdvProc
     * @return YousignClientV3\Client
     */
    public function setIdAdvProc(string $idAdvProc): Client
    {
        $this->idAdvProc = $idAdvProc;
        return $this;
    }

    /**
     * @return array
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * @param array $member
     * @return YousignClientV3\Client
     */
    public function setMember(array $member): Client
    {
        $this->member = $member;
        return $this;
    }

    /**
     * @return array
     */
    public function getFileobject(): array
    {
        return $this->fileobject;
    }

    /**
     * @param array $fileobject
     * @return YousignClientV3\Client
     */
    public function setFileobject(array $fileobject): Client
    {
        $this->fileobject = $fileobject;
        return $this;
    }

    /**
     * @return string
     */
    public function getSignatureRequestId(): string
    {
        return $this->signatureRequestId;
    }

    /**
     * @param string $signatureRequestId
     * @return YousignClientV3\Client
     */
    public function setSignatureRequestId(string $signatureRequestId): Client
    {
        $this->signatureRequestId = $signatureRequestId;
        return $this;
    }

    /**
     * @return array
     */
    public function getDocumentUploadResponse(): array
    {
        return $this->documentUploadResponse;
    }

    /**
     * @param array $documentUploadResponse
     * @return YousignClientV3\Client
     */
    public function setDocumentUploadResponse(array $documentUploadResponse): Client
    {
        $this->documentUploadResponse = $documentUploadResponse;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentId(): string
    {
        return $this->documentId;
    }

    /**
     * @param string $documentId
     * @return YousignClientV3\Client
     */
    public function setDocumentId(string $documentId): Client
    {
        $this->documentId = $documentId;
        return $this;
    }

    /**
     * @return array
     */
    public function getAddSignerResponse(): array
    {
        return $this->addSignerResponse;
    }

    /**
     * @param array $addSignerResponse
     * @return YousignClientV3\Client
     */
    public function setAddSignerResponse(array $addSignerResponse): Client
    {
        $this->addSignerResponse = $addSignerResponse;
        return $this;
    }

    /**
     * @return array
     */
    public function getActivateSignatureResponse()
    {
        return $this->ActivateSignatureResponse;
    }

    /**
     * @param array $ActivateSignatureResponse
     * @return YousignClientV3\Client
     */
    public function setActivateSignatureResponse(array $ActivateSignatureResponse): Client
    {
        $this->ActivateSignatureResponse = $ActivateSignatureResponse;
        return $this;
    }

    private function post($url, $data)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    /**
     * les méthodes de procédure Yousign dans l'ordre d'utilisation
     */

    /**
     * @param array $dataArray
     * @return array|mixed
     */

    public function newSignatureRequest(array $dataArray)
    {
        ## 1 - Create a Signature Request:
        // $data = <<<JSON
        // {
        //   "name": "The name of your Signature Request",
        //   "delivery_mode": "email",
        //   "timezone": "Europe/Paris"
        // }
        // JSON;

        $data = json_encode($dataArray);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => sprintf('%s/signature_requests', $this->apiBaseUrlWslash),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $initiateSignatureRequestResponse = curl_exec($curl);
        $this->signatureRequest = json_decode($initiateSignatureRequestResponse, true);
        $this->signatureRequestId = $this->signatureRequest['id'];

        curl_close($curl);

        return $this->signatureRequest;

    }

    /**
     * @param string $pdfDocumentPath
     * @return array|mixed
     */
    public function addDocument(string $pdfDocumentPath)
    {
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL => sprintf('%s/signature_requests/%s/documents', $this->apiBaseUrlWslash, $this->signatureRequestId),
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => [
                    'file' => new \CURLFile($pdfDocumentPath, 'application/pdf'),
                    'nature' => 'signable_document',
                    'parse_anchors' => 'true'
                ],
                CURLOPT_HTTPHEADER => [
                    sprintf('Authorization: Bearer %s', $this->apikey),
                ],
            ]);

        $initDocumentUploadResponse = curl_exec($curl);
        $this->documentUploadResponse = json_decode($initDocumentUploadResponse, true);
        $this->documentId = $this->documentUploadResponse['id'];

        curl_close($curl);

        return $this->documentUploadResponse;

    }

    /**
     * @param array $signerArray
     * @return array|mixed
     */
    public function addSigner(array $signerArray)
    {
        ## 3 - Add a Signer to the Signature Request:
        // $data = <<<JSON
        // {
        //   "info": {
        //     "first_name": "John",
        //     "last_name": "Doe",
        //     "email": "john.doe@example.com",
        //     "phone_number": "+33700000000",
        //     "locale": "fr"
        //   },
        //   "signature_authentication_mode": "no_otp",
        //   "signature_level": "electronic_signature",
        //   "fields": [
        //     {
        //       "document_id": "{$documentId}",
        //       "type": "signature",
        //       "height": 37,
        //       "width": 85,
        //       "page": 1,
        //       "x": 0,
        //       "y": 0
        //     }
        //   ]
        // }
        //JSON;
        $data = json_encode($signerArray);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => sprintf('%s/signature_requests/%s/signers', $this->apiBaseUrlWslash, $this->signatureRequestId),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $initaddSignerResponse = curl_exec($curl);
        $this->addSignerResponse = json_decode($initaddSignerResponse,true);
        curl_close($curl);

        return $this->addSignerResponse;
    }

    /**
     * @return array|mixed
     */
    public function activateSignatureRequest()
    {
        ## 4 - Activate the Signature Request:

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => sprintf('%s/signature_requests/%s/activate', $this->apiBaseUrlWslash, $this->signatureRequestId),
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $initActivateSignatureRequestResponse = curl_exec($curl);

        $this->ActivateSignatureResponse = json_decode($initActivateSignatureRequestResponse,true);
        curl_close($curl);

        return $this->ActivateSignatureResponse;
    }

    public function createWebhook($params)
    {
        // data for all event :
        // la V3 de Yousign permet la création de 5 Webhook differents
        /*
        $data = {"sandbox":true,"auto_retry":true,"enabled":true,"subscribed_events":["*"],"endpoint":"https://mondomaine.com/routequirecoiteventyousign","description":"all event "}
        */

        ## 4 - create webhook:
        $data=json_encode($params);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => sprintf('%s/webhooks', $this->apiBaseUrlWslash),
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $initAddWebHookRequestResponse = curl_exec($curl);

        $this->AddWebHookResponse = json_decode($initAddWebHookRequestResponse,true);
        curl_close($curl);

        return $this->AddWebHookResponse;


    }



    public function AdvancedProcedureCreate($parameters,$webhook = false,$webhookMethod = '',$webhookUrl = '',$webhookHeader = '')
    {
        /*
         $parameters = array(
            'name' => "Procédure de signature Wizi",
            'description' => "Procedure from BO ",
            'start'=> false
        );
         */

        ## 1 - Create a Signature Request:
        // $data = <<<JSON
        // {
        //   "name": "The name of your Signature Request",
        //   "delivery_mode": "email",
        //   "timezone": "Europe/Paris"
        // }
        // JSON;
        $dataArray = [
            "name" => $parameters["description"],
            "delivery_mode" => "none",
            "timezone" => "Europe/Paris"
        ];

        $data = json_encode($dataArray);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => sprintf('%s/signature_requests', $this->apiBaseUrlWslash),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $initiateSignatureRequestResponse = curl_exec($curl);
        $this->signatureRequest = json_decode($initiateSignatureRequestResponse, true);
        $this->signatureRequestId = $this->signatureRequest['id'];

        curl_close($curl);

        return $this->signatureRequest;


    }

    public function countPages($file){
        $res = shell_exec("pdfinfo ".escapeshellarg($file)." | grep Pages");
        if(!substr_count($res, 'Pages:')) return false;
        $n = intval(trim(substr($res, strlen('Pages:')+1)));
        if($n<=0) return false;
        return $n;
    }

    public $nbPages;

    public function AdvancedProcedureAddFile($filepathOrFileContent,$namefile,$filecontent = false)
    {
        $this->nbPages = $this->countPages($this->pdfBaseDir.$namefile);



        $pdfDocumentPath = $namefile;
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL => sprintf('%s/signature_requests/%s/documents', $this->apiBaseUrlWslash, $this->signatureRequestId),
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => [
                    'file' => new \CURLFile($this->pdfBaseDir.$pdfDocumentPath, 'application/pdf'),
                    'nature' => 'signable_document',
                    'parse_anchors' => 'true'
                ],
                CURLOPT_HTTPHEADER => [
                    sprintf('Authorization: Bearer %s', $this->apikey),
                ],
            ]);

        $initDocumentUploadResponse = curl_exec($curl);
        $this->documentUploadResponse = json_decode($initDocumentUploadResponse, true);
        $this->documentId = $this->documentUploadResponse['id'];

        curl_close($curl);


        return $this->documentUploadResponse;

    }

    public function AdvancedProcedureAddMember($firstname,$lastname,$email,$phone)
    {
        $this->signerData = [
            "info" => [
                "first_name" => $firstname,
                "last_name" => $lastname,
                "email" => $email,
                "phone_number" => $phone,
                "locale" => "fr"
            ],
            "signature_authentication_mode" => "otp_sms",
            "signature_level" => "electronic_signature",
            "fields" => [
                [
                    "document_id" => $this->getDocumentId(),
                    "type" => "signature",
                    "height" => 37,
                    "width" => 85,
                    "page" => $this->nbPages,
                    "x" => 0,
                    "y" => 0]
            ]
        ];



        return json_encode($this->signerData);

    }

    public function AdvancedProcedureFileObject($position,$page,$mention,$mention2,$reason)
    {
        // '{"info":{"locale":"en"},"signature_level":"electronic_signature","fields":[{"type":"mention","mention":"ma super mention","page":50,"x":10,"y":100}]}',
        // $position = '48,32,248,132';
        $positionData = explode(",",$position);
        $this->signerData['fields'] = [
            [
                "document_id" => $this->getDocumentId(),
                "type" => "signature",
                // "height" => (int)$positionData[1] +6,
                // "width" => (int)$positionData[0] +40,
                "page" => $this->nbPages,
                "x" => (int)$positionData[2]-220,
                "y" => (int)$positionData[3]+120
            ],
            [
                "document_id" => $this->getDocumentId(),
                "type" => "mention",
                "mention" => $mention,
                "page" => $this->nbPages,
                "x" => (int)$positionData[2]-220,
                "y" => (int)$positionData[3]-20+120
            ],
            [
                "document_id" => $this->getDocumentId(),
                "type" => "mention",
                "mention" => $mention2,
                "page" => $this->nbPages,
                "x" => (int)$positionData[2]-220,
                "y" => (int)$positionData[3]-12+120
            ]
        ];
        $data = json_encode($this->signerData);




        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => sprintf('%s/signature_requests/%s/signers', $this->apiBaseUrlWslash, $this->signatureRequestId),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $initaddSignerResponse = curl_exec($curl);
        $this->addSignerResponse = json_decode($initaddSignerResponse,true);
        curl_close($curl);

        return $this->addSignerResponse;

    }

    public function AdvancedProcedurePut()
    {
        ## 4 - Activate the Signature Request:

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => sprintf('%s/signature_requests/%s/activate', $this->apiBaseUrlWslash, $this->signatureRequestId),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $initActivateSignatureRequestResponse = curl_exec($curl);

        $this->ActivateSignatureResponse = json_decode($initActivateSignatureRequestResponse,true);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);




        return $this->ActivateSignatureResponse;
        if ($httpcode == 200){
            return $this->ActivateSignatureResponse;
        } else {
            return false;
        }

    }

    public function AdvancedProcedureGetMembers()
    {
        // recuperer la liste des membres

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => sprintf('%s/signature_requests/%s/signers', $this->apiBaseUrlWslash, $this->signatureRequestId),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $initListMemberRequestResponse = curl_exec($curl);

        $this->memberList = json_decode($initListMemberRequestResponse,true);
        curl_close($curl);




        return $this->memberList;
    }

    public function AdvancedProcedureGetSignLink($memberId)
    {
        // GET /signature_requests/b9bf5521-00eb-4044-adf5-da4ea31a48e0/signers/395375bb-93d9-4762-8e11-5caa4734afc1

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => sprintf('%s/signature_requests/%s/signers/%s', $this->apiBaseUrlWslash, $this->signatureRequestId,$memberId),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $initSignLinkRequestResponse = curl_exec($curl);

        $this->signLink = json_decode($initSignLinkRequestResponse,true);
        curl_close($curl);



        return $this->signLink;

    }

    public function downloadSignedFile($fileid, $mode)
    {
        // https://api-sandbox.yousign.app/v3/signature_requests/{signatureRequestId}/documents/{documentId}/download
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => sprintf('%s/signature_requests/%s/documents/%s/download', $this->apiBaseUrlWslash, $fileid['srid'],$fileid['docid']),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $response = curl_exec($curl);

        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($mode == '64'){
            return base64_encode($response);
        } else {
            return $response;
        }

        if ($httpcode == 200){
            return $response;
        } else {
            return false;
        }

    }

    public function downloadSignedFileInfos($fileid, $mode)
    {
        // https://api-sandbox.yousign.app/v3/signature_requests/{signatureRequestId}/documents/{documentId}
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => sprintf('%s/signature_requests/%s/documents/%s', $this->apiBaseUrlWslash, $fileid['srid'],$fileid['docid']),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $response = curl_exec($curl);

        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);


        json_decode($response,true);


        return json_decode($response,true);
        if ($httpcode == 200){
            return $response;
        } else {
            return false;
        }

    }

    public function AdvancedProcedureGetProofFile($memberId,$requestID)
    {
        // https://api-sandbox.yousign.app/v3/signature_requests/{signatureRequestId}/signers/{signerId}/audit_trails/download

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => sprintf('%s/signature_requests/%s/signers/%s/audit_trails/download',$this->apiBaseUrlWslash, $requestID,$memberId),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
                'Content-Type: application/json'
            ],
        ]);

        $initSignProofRequestResponse = curl_exec($curl);

        $this->SignProof =$initSignProofRequestResponse;
        curl_close($curl);


        return $this->SignProof;

    }

}
