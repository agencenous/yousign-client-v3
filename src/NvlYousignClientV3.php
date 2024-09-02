<?php


namespace OlivierNvlYousignClientApiV3;


class NvlYousignClientV3
{
    /**
     * @var string
     */
    private $apiBaseUrl;
    /**
     * @var string
     */
    private $apiBaseUrlWslash;


    /**
     * NvlYousignClientV3 constructor.
     * @param $apikey
     * @param $mode
     */
    public function __construct($apikey,$mode)
    {
        $this->setApikey($apikey);
        if($mode == 'prod'){
            $this->apiBaseUrl = 'https://api.yousign.com/';
            $this->apiBaseUrlWslash = 'https://api.yousign.com';
        }else{
            $this->apiBaseUrl = 'https://staging-api.yousign.com/';
            $this->apiBaseUrlWslash = 'https://staging-api.yousign.com';
        }
    }

    


}
