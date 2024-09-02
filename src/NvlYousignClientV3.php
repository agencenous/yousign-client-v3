<?php


namespace OlivierNvlYousignClientApiV3;


class NvlYousignClientV3
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
    private $documentId;
    /**
     * @var array
     */
    private $addSignerResponse;

    /**
     * @var array
     */
    private $ActivateSignatureResponse;

    /**
     * NvlYousignClientV3 constructor.
     * @param $apikey
     * @param $mode
     */
    public function __construct($apikey)
    {
        // le mode dev ou prod se fait en fonction de la clef d'API
        $this->setApikey($apikey);

        $this->apiBaseUrl = 'https://api-sandbox.yousign.app/v3/';
        $this->apiBaseUrlWslash = 'https://api-sandbox.yousign.app/v3';
    }

    public static function world()
    {
        return "Client pour l'api Yousign V3";
    }


    /**
     *  les get et set génériques
     */


    /**
     * @return array
     */
    public function getSignatureRequest(): array
    {
        return $this->signatureRequest;
    }

    /**
     * @param array $signatureRequest
     * @return NvlYousignClientV3
     */
    public function setSignatureRequest(array $signatureRequest): NvlYousignClientV3
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
     * @return NvlYousignClientV3
     */
    public function setApikey(string $apikey): NvlYousignClientV3
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
     * @return NvlYousignClientV3
     */
    public function setApiBaseUrl(string $apiBaseUrl): NvlYousignClientV3
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
     * @return NvlYousignClientV3
     */
    public function setApiBaseUrlWslash(string $apiBaseUrlWslash): NvlYousignClientV3
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
     * @return NvlYousignClientV3
     */
    public function setIdfile(string $idfile): NvlYousignClientV3
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
     * @return NvlYousignClientV3
     */
    public function setIdAdvProc(string $idAdvProc): NvlYousignClientV3
    {
        $this->idAdvProc = $idAdvProc;
        return $this;
    }

    /**
     * @return array
     */
    public function getMember(): array
    {
        return $this->member;
    }

    /**
     * @param array $member
     * @return NvlYousignClientV3
     */
    public function setMember(array $member): NvlYousignClientV3
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
     * @return NvlYousignClientV3
     */
    public function setFileobject(array $fileobject): NvlYousignClientV3
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
     * @return NvlYousignClientV3
     */
    public function setSignatureRequestId(string $signatureRequestId): NvlYousignClientV3
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
     * @return NvlYousignClientV3
     */
    public function setDocumentUploadResponse(array $documentUploadResponse): NvlYousignClientV3
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
     * @return NvlYousignClientV3
     */
    public function setDocumentId(string $documentId): NvlYousignClientV3
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
     * @return NvlYousignClientV3
     */
    public function setAddSignerResponse(array $addSignerResponse): NvlYousignClientV3
    {
        $this->addSignerResponse = $addSignerResponse;
        return $this;
    }

    /**
     * @return array
     */
    public function getActivateSignatureResponse(): array
    {
        return $this->ActivateSignatureResponse;
    }

    /**
     * @param array $ActivateSignatureResponse
     * @return NvlYousignClientV3
     */
    public function setActivateSignatureResponse(array $ActivateSignatureResponse): NvlYousignClientV3
    {
        $this->ActivateSignatureResponse = $ActivateSignatureResponse;
        return $this;
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
                    'file' => new CURLFile($pdfDocumentPath, 'application/pdf'),
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
    
}
