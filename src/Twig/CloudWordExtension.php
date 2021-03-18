<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CloudWordExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('CloudWord', [$this, 'makeCloud'], ['is_safe' => ['html']]),
        ];
    }

    public function makeCloud($texte)
    {
        $randomcolor = '#' . dechex(rand(0, 10000000));
        $size = rand(70, 200) / 100;
        return "<span style='color:$randomcolor;font-size:" . $size . "rem;'>$texte</span>";
    }
}
