<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum Rating: string
{
    use Values;

    case G = 'G';
    case PG = 'PG';
    case PG_13 = 'PG-13';
    case R = 'R';
    case NC_17 = 'NC-17';
}
