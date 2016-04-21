<?php
namespace App\Transformers;

abstract class Transformer
{
    public function test()
    {
        return 'test';
    }

    public function transformCollection(array $items)
    {
        return [
          'data'=> array_map([$this, 'transform'], $items)
        ];
    }

    public abstract function transform($item);

}
