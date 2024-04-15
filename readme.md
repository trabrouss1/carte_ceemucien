# CEEMUCI

Ceci est un projet spécialement pour la CEEMUCI (Communaute des élèves et étudiants musulmans de Côte d'Ivoire )

![logo_ceemuci.jpeg](public%2Flogo_ceemuci.jpeg)

## Objectif 

Nous voulons a travers ce projet aidé la communauté musulmane à s'agrandir.
Ceux avec ce que nous savons faire.

### Commande a execulter

installation de tous les dépendances.
`composer install && composer update`,

#### Pour exposer une route :
Ajouter options: ['expose' => true] à la définition de la route dans le controller puis taper la commande ci-après :
`php bin/console fos:js-routing:dump --format=json --target=assets/js/routes.json`

### Technologie utilisée
Bundle : vich/uploader, gedmo, knp_paginator, jsRouting
