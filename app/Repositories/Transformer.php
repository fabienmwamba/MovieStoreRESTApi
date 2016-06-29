<?php
namespace App\Repositories;


abstract class Transformer
{
    const PER_PAGE = 5;

    public function transformCollection($items)
    {
        return [
            'total' => $items['total'],
            'per_page' => intval($items['per_page']),
            'current_page' => $items['current_page'],
            'next_page_url' => $items['next_page_url'],
            'prev_page_url' => $items['prev_page_url'],
            'from' => $items['from'],
            'to' => $items['to'],
            'data'=>array_map([$this, 'transform'], $items['data'])
        ];
    }

    public abstract function transform($item);
}
