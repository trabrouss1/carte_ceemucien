<?php

namespace App\Twig;

use DateTime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigExtensionHlper extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('isInstanceOfHlper', [$this, 'isInstanceOf']),
            new TwigFunction('currencyFormatHlper', [$this, 'currencyFormat']),
            new TwigFunction('dateFormatHlper', [$this, 'dateFormat']),
            new TwigFunction('inputHlper', [$this, 'formInput']),
        ];
    }

    public function isInstanceOf($object, string $className): bool
    {
        return $object instanceof $className;
    }

    public function currencyFormat(?float $currencyValue, ?string $currency = "F CFA", int $decimals = 2): string
    {
        return number_format($currencyValue != null ? $currencyValue : 0, $decimals, ",", " ") . " $currency";
    }


    public function formInput(string $label = null, string $type = "text", string $class = null, string|int $name = null, string $value = null)
    {
        return "<div class='form-group $class'>
            <label for='$name'>$label</label>
                <input class='form-control' type='$type' name='$name' id='$name' value='$value' />
        </div>";
    }

    /**
     * @param $date - La date à formater
     *
     * @param $format - Le format de la date. Valeur par défaut = "fr" => "d-m-Y"
     *
     * @param $heure - Faut-il faire apparaître l'heure ? La valeur par défaut c'est 0. Cela
     * signifie que l'heure n'apparaitra pas dans le retour de la fonction. Si le paramètre
     * vaut 1 alors, on aura l'heure au format H:i. S'il vaut 2, le format de l'heure dans
     * le retour de la fonction sera H:i:s
     */
    public function dateFormat(?DateTime $date, string $format = "fr", int $heure = 0): ?string
    {
        if ($date == null || empty($date)) {
            return null;
        }

        $formatedDate = '';
        if ($format == 'fr') {
            $formatedDate .= $date->format('d-m-Y');
        } else {
            $formatedDate .= $date->format('Y-m-d');
        }

        if ($heure == 1) {
            $formatedDate .= ' ' . $date->format('H:i');
        } elseif ($heure == 2) {
            $formatedDate .= ' ' . $date->format('H:i:s');
        }
        return $formatedDate;
    }
}