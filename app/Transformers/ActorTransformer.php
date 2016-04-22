<?php
namespace App\Transformers;

use App\Transformers\Transformer;

class ActorTransformer extends Transformer
{
  public function transform($actor)
  {
      return [
        'first_name'=>$actor['firstname']
      ];
  }
}
