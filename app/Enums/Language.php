<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum Language: string
{
    use Values;

    case HUNGARIAN = 'hungarian';
    case ENGLISH = 'english';
    case SPANISH = 'spanish';
    case FRENCH = 'french';
    case GERMAN = 'german';
    case ITALIAN = 'italian';
}
