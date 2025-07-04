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

    /**
     * Calls the API
     * 
     * @param string $method
     * @param string $url
     * @param array|null $data
     * @param bool $raw if true, returns raw response, if false returns json_decoded response
     * 
     * @return array
     */
    private function api(string $method, string $url, ?array $data=null, $raw=false){
        $curl = curl_init();
        $curl_params = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => [
                sprintf('Authorization: Bearer %s', $this->apikey),
            ],
        ];
        if ($data) {
            // If data if a document, do not enode it
            if(!empty($data['file'])){
                $curl_params[CURLOPT_POSTFIELDS] = $data;

            }
            // If data is an array, encode it to JSON
            else{
                $curl_params[CURLOPT_POSTFIELDS] = json_encode($data);
                $curl_params[CURLOPT_HTTPHEADER][] = 'Content-Type: application/json';

            }
        }
        curl_setopt_array($curl, $curl_params);

        $response = curl_exec($curl);

        // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if($raw){
            return $response;
        }

        return json_decode($response, true);
    }

    /**
     * POST request
     * 
     * @param string $url
     * @param array|null $data
     * 
     * @return array
     */
    private function post(string $url, ?array $data=null, $raw=false)
    {
        return $this->api('POST', $url, $data, $raw);
    }

    /**
     * GET request
     * 
     * @param string $url
     * @param array|null $data
     * 
     * @return array
     */
    private function get(string $url, ?array $data=null, $raw=false)
    {
        return $this->api('GET', $url, $data, $raw);
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
        // $data = <<<JSON
        // {
        //   "type":"parameters_not_valid",
        //   "detail":"You have some invalid params in your payload.",
        //   "invalid_params":[
        //      {
        //          "name":"name",
        //          "reason":"This value is too long. It should have 128 characters or less."
        //      }
        //   ]
        // }
        // JSON;

        $url = sprintf('%s/signature_requests', $this->apiBaseUrlWslash);

        $response  = $this->post($url, $dataArray);

        if(isset($response['type']) && $response['type'] == 'parameters_not_valid'){
            throw new \Exception('Error creating signature request: ' . $response['detail'].
                ' Invalid params: ' . json_encode($response['invalid_params']));
        }

        $this->signatureRequest = $response;
        $this->signatureRequestId = $this->signatureRequest['id'];

        return $this->signatureRequest;

    }

    /**
     * @param string $pdfDocumentPath
     * @return array|mixed
     */
    public function addDocument(string $pdfDocumentPath)
    {
        $data = [
                    'file' => new \CURLFile($pdfDocumentPath, 'application/pdf'),
                    'nature' => 'signable_document',
                    'parse_anchors' => 'true'
        ];
        $url = sprintf('%s/signature_requests/%s/documents', $this->apiBaseUrlWslash, $this->signatureRequestId);

        $this->documentUploadResponse = $this->post($url, $data);
        
        $this->documentId = $this->documentUploadResponse['id'];

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
        $url  = sprintf('%s/signature_requests/%s/signers', $this->apiBaseUrlWslash, $this->signatureRequestId);

        $this->addSignerResponse = $this->post($url, $signerArray);

        return $this->addSignerResponse;
    }

    /**
     * @return array|mixed
     */
    public function activateSignatureRequest()
    {
        ## 4 - Activate the Signature Request:

        $url = sprintf('%s/signature_requests/%s/activate', $this->apiBaseUrlWslash, $this->signatureRequestId);

        $this->ActivateSignatureResponse = $this->post($url);

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
        $url = sprintf('%s/webhooks', $this->apiBaseUrlWslash);

        $this->AddWebHookResponse = $this->post($url, $params);

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
        $url = sprintf('%s/signature_requests', $this->apiBaseUrlWslash);

        $this->signatureRequest = $this->post($url, $dataArray);
        $this->signatureRequestId = $this->signatureRequest['id'];

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
        $url = printf('%s/signature_requests/%s/documents', $this->apiBaseUrlWslash, $this->signatureRequestId);
        $data = [
            'file' => new \CURLFile($this->pdfBaseDir.$pdfDocumentPath, 'application/pdf'),
            'nature' => 'signable_document',
            'parse_anchors' => 'true'
        ];

        $this->documentUploadResponse = $this->post($url, $data);
        $this->documentId = $this->documentUploadResponse['id'];

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
        $url = sprintf('%s/signature_requests/%s/signers', $this->apiBaseUrlWslash, $this->signatureRequestId);

        $this->addSignerResponse = $this->post($url, $this->signerData);
   
        return $this->addSignerResponse;

    }

    public function AdvancedProcedurePut()
    {
        ## 4 - Activate the Signature Request:
        $url = sprintf('%s/signature_requests/%s/activate', $this->apiBaseUrlWslash, $this->signatureRequestId);

        $this->ActivateSignatureResponse = $this->post($url);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        return $this->ActivateSignatureResponse;
        if ($httpcode == 200){
            return $this->ActivateSignatureResponse;
        } else {
            return false;
        }
    }

    /**
     * recuperer la liste des membres
     * 
     * @return array|mixed
     */
    public function AdvancedProcedureGetMembers()
    {

        $url = sprintf('%s/signature_requests/%s/signers', $this->apiBaseUrlWslash, $this->signatureRequestId);

        $this->memberList = $this->get($url);

        return $this->memberList;
    }

    public function AdvancedProcedureGetSignLink($memberId)
    {
        // GET /signature_requests/b9bf5521-00eb-4044-adf5-da4ea31a48e0/signers/395375bb-93d9-4762-8e11-5caa4734afc1

        $url = sprintf('%s/signature_requests/%s/signers/%s', $this->apiBaseUrlWslash, $this->signatureRequestId,$memberId);

        $this->signLink = $this->get($url);

        return $this->signLink;

    }

    public function downloadSignedFile($fileid, $mode)
    {
        // https://api-sandbox.yousign.app/v3/signature_requests/{signatureRequestId}/documents/{documentId}/download
        $url = sprintf('%s/signature_requests/%s/documents/%s/download', $this->apiBaseUrlWslash, $fileid['srid'],$fileid['docid']);

        $response = $this->get($url, null, true);
        if (!$response){
            return false;
        }

        if($mode == '64'){
            return base64_encode($response);
        } else {
            return $response;
        }
    }

    public function downloadSignedFileInfos($fileid, $mode)
    {
        // https://api-sandbox.yousign.app/v3/signature_requests/{signatureRequestId}/documents/{documentId}

        $url = sprintf('%s/signature_requests/%s/documents/%s', $this->apiBaseUrlWslash, $fileid['srid'],$fileid['docid']);

        $response = $this->get($url);
        return $response;

    }

    public function AdvancedProcedureGetProofFile($memberId,$requestID)
    {
        // https://api-sandbox.yousign.app/v3/signature_requests/{signatureRequestId}/signers/{signerId}/audit_trails/download

        $url = sprintf('%s/signature_requests/%s/signers/%s/audit_trails/download',$this->apiBaseUrlWslash, $requestID,$memberId);

        $this->SignProof = $this->get($url, null, true);

        return $this->SignProof;

    }

}
