<?php

namespace App\DTO;

enum SortFieldEnum: string
{
    case Price = 'price';
    case Date = 'created_at';
}
