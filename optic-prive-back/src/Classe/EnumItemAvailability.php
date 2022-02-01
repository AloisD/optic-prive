<?php

namespace App\Classe;

class EnumItemAvailability extends EnumType
{
  protected $name = 'enumItemAvailability';
  protected $values = array('backOrder', 'discontinued', 'inStock', 'inStoreOnly','limitedAvailability', 'onlineOnly', 'outOfStock', 'preOrder', 'preSale', 'soldOut');
}
