<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice']),
            new TwigFilter('stars', [$this, 'stars'], ['is_safe' => ['html']]),
            new TwigFilter('dateFR', [$this, 'dateFR'], ['is_safe' => ['html']]),
            new TwigFilter('formatPhone', [$this, 'formatPhone']),
        ];
    }

    public function formatPrice($number, $symbol, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        //DONE: il faudrait améliorer encore ce code car le symbole ne se met pas à la fin si le nombre est en dollar par exemple.
        if ($symbol == '€') {
            $price = $price . ' €';
        }
        elseif ($symbol == '$') {
            $price = '$ '.$price;
        }

        return $price;
    }

    public function stars($note)
    {
        $html = '';
        for ($i = 0; $i < $note; $i++) {
            $html .= '<i class="fas fa-star"></i>';
        }
        for ($i = 0; $i < 5 - $note; $i++) {
            $html .= '<i class="far fa-star"></i>';
        }

        return $html;
    }

    public function dateFR($date)
    {
        $date = new \DateTime($date);
        $date = $date->format('d/m/Y');
        return $date;
    }

    public function formatPhone($phone)
    {
        $phone = substr(chunk_split($phone, 2, ' '), 0, -1);
        return $phone;
    }
}
