# yousign-client-v3
 client pour l'Api V3 de Yousign 2024 PHP

 Fork de [https://github.com/oliviernival/yousign-client-api-V3-2024](oliviernival/yousign-client-api-V3-2024)

# site officiel de Yousign la doc :

https://developers.yousign.com/docs/introduction-new

# Installation
via composer
```php 
composer require agencenous/yousign-client-v3
```
# Utilisation

```php
<?php
require_once '/path/to/vendor/autoload.php';
$apikey = "votre-clef-yousign";
$mode = "prod"; // ou "dev" pour url de dev de yousign
$client = new YousignClientV3\Client($apikey,$mode);
$opt = [
            "name" => "le nom de ma signature",
            "delivery_mode" => "email",
            "timezone" => "Europe/Paris",
        ];

// initialisation        
$reqSignature = $client->newSignatureRequest($opt);

// ajout du doc à signer
$addDoc = addDocument($pdfDocumentPath)

// on ajoute une personne qui doit signer

$signer = [
    "info" => [
        "first_name"  => "John",
        "last_name"   => "Doe",
        "email"       => "john.doe@example.com",
        "phone_number"=> "+33700000000",
        "locale"      => "fr"
    ],
    "signature_authentication_mode" => "no_otp",
    "signature_level" => "electronic_signature",
    "fields" => [
        [
            "document_id"=> $client->getDocumentId(),
            "type"  => "signature",
            "height"=> 37,
            "width" => 85,
            "page"  => 1,
            "x"     => 0,
            "y"     => 0]
    ]
];

$addSigner = $client->addSigner($signer);

// on active la signature a partir de ce moment le document peut être signé par les personnes
        
$client->activateSignatureRequest();
```

# Les webhook

nous pouvons via l'API créer des webhook dans la limite de 5

cela va nous permettre de dire à Yousign de nous envoyer des requettes avec les infos,
au différentes étapes de la signature.
Nous avons donc la possibilité de créer des webhook qui alertent à toutes les étapes ou seulement à certaines.

```php
// création du webhook

// webhook pour avoir tous les events :
// la V3 de Yousign permet la création de 5 Webhook differents
        
$params = [
    "sandbox"           => true,
    "auto_retry"        => true,
    "enabled"           => true,
    "subscribed_events" => ["*"],
    "endpoint"          => "https://mondomaine.com/routequirecoiteventyousign",
    "description"       => "all event "
];
$client->createWebhook($params);

```

# les méthodes pour les procédures avancées ont été ajoutées. elle s'utilisent sensiblement de la même façon que pour le sdk V2

Voici un exemple d'utilisation :

Certains paramètres ne seront pas utilisés dans les méthodes je les ai gardé uniquement pour simplifier le passage de l'utilisation du SDK V2 à V3

ainsi pour la plupart des méthodes de procédures avancées les signatures sont exactement les memes

```php

// création de la signature du document en mode avancé avec vérif sms

$mode = "prod";

$wizisign = new YousignClientV3\YousignClientV3('yourapikey',$mode);

// on indique le chemin du répertoire du fichier pdf
// chemin absolut du répertoire du fichier pdf à signer pour les procédures avancés :
// $this->pdfBaseDir = '/home/web/pdftemp/'; // c'est la valeur par défaut

// si le dossier ou se trouve le pdf est : '/home/www/pdftemp',
// on utilise la méthode pour changer l'emplacement par défaut comme ceci
$wizisign->setPdfBaseDir('/home/www/pdftemp');

/**
         * ici nous créons une procedure en mode avancé
         *
         */
        $parameters = array(
            'name' => "nom de la procédure",
            'description' => "description de la procédure",
            'start'=> false
        );

        /**
         * initialisation de la procedure
         *
         * @param $parameters
         * @param bool $notifmail
         * @return bool|string
         */
        $webhookUrl = "";// paramètre gardé uniquement pour garder les mêmes signatures de fonctions que le sdk de la V2
        $wizisignres = $wizisign->AdvancedProcedureCreate($parameters,
            $webhook = true,$webhookMethod = 'POST',$webhookUrl,$webhookHeader = 'testwebhook');
        
        /**
         * ici on ajoute le fichier à signer avec le chemin du fichier et le nom que l'on veut en sortie
         */
        $wizisign->AdvancedProcedureAddFile($fileContent,$fileName,true);
        
        $wizisign->AdvancedProcedureAddMember('prenom','nom','email','numerodetelephone');
        $position = '48,32,248,132';
        $page = 50;
        $mention = "Lu et approuvé";
        $mention2 = "Signé par ".'prenom'." ".'nom';
        $reason = "Signé par ".'prenom'." ".'nom'." (Yousign)";
        $lastSigner= $wizisign->AdvancedProcedureFileObject($position,$page,$mention,$mention2,$reason);

        /**
         * ici on sauvegarde l'id du membre
         */
        
        $membreid = $lastSigner['id'];

        /**
         * start de la procedure nouvelle api yousign
         *
         * lien de signature
         * src="https://webapp.yousign.com/procedure/sign?members=/members/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxx"
         */
        $result = $wizisign->AdvancedProcedurePut();
        
        if($result === false){
            // il y a erreur
        }else{
            // utile d'enregistrer ces infos en base de données celon votre architecture
            $requestId = $wizisign->getSignatureRequestId();
            $YsdocId = $wizisign->getDocumentId();
            
            
            $memberlist = $wizisign->AdvancedProcedureGetMembers();
            
            // maping pour que ça soit les memes indices et tableaux que pour la V2
            foreach ($memberlist as $key => $m){
                $memberlist[$key]["firstname"] = $m["info"]["first_name"];
                $memberlist[$key]["lastname"] = $m["info"]["last_name"];
                $memberlist[$key]["email"] = $m["info"]["email"];

            }
            
            foreach ($memberlist as $value) {
                // à enregistrer dans votre DB utile pour récupérer plus tard les fichiers de peuves par exemple
                $membreid = $value['id'];

            }
            
            $signLinkObj = $wizisign->AdvancedProcedureGetSignLink($membreid);
            // url à faire parvenir par mail à la personne qui doit signer
            $urlOwner = $signLinkObj['signature_link'];
            
        
        }

```
# récupérer signature via le webhook envoyé par yousign

Vous devez avoir créé un webhook qui envoie une requette vers votre serveur pour chaque actions

```php
// exemple de route symfony qui reçoit le webhook

/**
     * Signer un document de contrat webhook yousign V3
     *
     * @Route("/sign-contract-document-v3", name="sign_contract_document_v3")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signContractDocumentV3Action(Request $request)
    {

        $request_body = $request->getContent();
        

        $request_bodyArray = array();
        $request_bodyArray = \json_decode($request_body, true);
        // new api
        $em = $this->getDoctrine()->getManager();
        $signatureToken = $request_bodyArray['data']['signer']['id']; // token correspondant dans document_signature id de celui qui signe
        $signatureStatus = $request_bodyArray['data']['signer']['status']; // "signed" pour document signé
        $signatureDocId = $request_bodyArray['data']['signature_request']['documents'][0]['id']; // doc id sur yousign
        $signatureRequestId = $request_bodyArray['data']['signature_request']['id']; // id de la procedure sur yousign

        $fileid = [
            'srid' => $request_bodyArray['data']['signature_request']['id'],
            'docid' => $request_bodyArray['data']['signature_request']['documents'][0]['id']
        ];


        // recup de ma signature en DB à adapter celon votre DB
        $signature = $em->getRepository('AppBundle:DocumentSignature')->findOneByToken($signatureToken);

        if ($signature and $signatureStatus == 'signed' and !$signature->isDone()) {
            $text = 'condition signature trouvée';

            

            // ici j'appelle un service symfony afin de traiter les choses
            //$this->get('app.contract')->signDocumentNewAPI($signature,$request_bodyArray);
            
            // pour l'exemple nous allons faire le traitement ici'
            
           $fileapiid = [
            'srid' => $request_bodyArray['data']['signature_request']['id'],
            'docid' => $request_bodyArray['data']['signature_request']['documents'][0]['id']
            ];
            
            $mode = "prod";

            $wizisign = new YousignClientV3\YousignClientV3('yourapikey',$mode);

            $fileInfosResultinterface = $wizisign->downloadSignedFileInfos($fileapiid,'64');
            $filePathInterface = $fileInfosResultinterface['filename']; 
            
            // maping pour avoir certains param comme dans la V2
            $request_bodyArray['procedure'] = [
            'files' => [
                [
                    'name' => $filePathInterface,
                    'id' => $request_bodyArray['data']['signature_request']['documents'][0]['id']
                ]
            ]
        ];
        
        // a cette étape vous pouvez sauver en DB que votre document est signé
        
        // on récup le doc signé
        
        $fileapiid = [
                    'srid' => $request_bodyArray['data']['signature_request']['id'],
                    'docid' => $request_bodyArray['data']['signature_request']['documents'][0]['id']
                ];

                $fileResult = $wizisign->downloadSignedFile($fileapiid,'64');
                
                $filePath = $fileInfosResult['filename'];

                $handle = fopen($filePath, 'w+');
                fwrite($handle, base64_decode($fileResult));
                fclose($handle);
                
                // voila ensuite à vous de faire ce que vous voulez du doc signé
            
        }

        return new Response();
    }


```
# Travaux en cours :
la méthode de récupération du fichier de preuve pour la signature d'un signataire