<?php

namespace App\Classe;

class EnumState extends EnumType
{
  protected $name = 'enumState';
  protected $values = array('damagedCondition', 'newCondition', 'refurbishedCondition', 'usedCondition');
}
