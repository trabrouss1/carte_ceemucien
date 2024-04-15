<?php

namespace App\Trait;

trait AccentEntitiesTrait
{
    public function accents_entities(string $string): string
    {
        // On commence par transformer les caractères utf8 en iso « ordinaire »
        $string = mb_convert_encoding(strtolower($string), 'utf8') ;
        // On définit la liste des caractères à remplacer :
        $caracteres=['é', 'è', 'à', 'ä', 'â', 'ë', 'ê', 'É', 'û', 'ü', 'ù', 'î', 'ï', 'ô', 'ö', 'ç', "'", ' '];
        // On définit les entités qui les remplaceront :
        $entities=['&eacute;', '&egrave;', '&agrave;', '&euml;', '&ecirc;', '&ucirc;', '&uuml;', '&ugrave;', '&icirc;', '&iuml;', '&ocirc;', '&ouml;'];
        $entities=['e', 'e', 'a', 'a', 'a', 'e', 'e', 'e', 'u', 'u', 'u', 'i', 'i', 'o', 'o', 'c', '-', '-'];
        // On applique le remplacement :
        $string = str_replace($caracteres, $entities, $string);
        // On retourne la nouvelle chaine :
        return $string;
    }
}
