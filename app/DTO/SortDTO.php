<?php

namespace App\DTO;

class SortDTO
{
    public string $field;
    public string $order;


    public function __construct(array $args)
    {
        $this->field = $args['sort'] ?? SortFieldEnum::Date->value;

        $this->order = $args['order'] ?? SortOrderEnum::DESC->value;
    }
}
