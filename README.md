# yousign-client-api-V3-2024
 client pour l'Api V3 de Yousign 2024 PHP

# site officiel de Yousign la doc :

https://developers.yousign.com/docs/introduction-new

# Installation
via composer
```php 
composer require oliviernival/yousign-client-api-v3-2024
```
# Utilisation

```php
<?php
require_once '/path/to/vendor/autoload.php';
$apikey = "votre-clef-yousign";
$mode = "prod"; // ou "dev" pour url de dev de yousign
$client = new NvlYousignClientApiV3\NvlYousignClientV3($apikey,$mode);
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