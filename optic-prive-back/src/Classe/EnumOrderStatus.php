<?php

namespace App\Classe;

class EnumOrderStatus extends EnumType
{
  protected $name = 'enumOrderStatus';
  protected $values = array('orderCancelled', 'orderDelivered', 'orderInTransit', 'orderPaymentDue','orderPickupAvailable', 'orderProblem', 'orderProcessing', 'orderReturned');
}
