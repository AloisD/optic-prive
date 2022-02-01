<?php

namespace App\Classe;

class EnumOfferStatus extends EnumType
{
  protected $name = 'enumOfferStatus';
  protected $values = array('active', 'out of stock');
}
