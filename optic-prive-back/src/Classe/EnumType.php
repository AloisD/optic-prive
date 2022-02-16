<?php

namespace App\Classe;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class EnumType extends Type
{
  protected $name;
  protected $values = array();

  public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
  {
    $values = array_map(function ($val) {
      return "'" . $val . "'";
    }, $this->values);

    return "ENUM(" . implode(", ", $values) . ")";
  }

  public function convertToPHPValue($value, AbstractPlatform $platform): mixed
  {
    return $value;
  }

  public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
  {
    if (is_null($value)) {
      return null;
    }

    if (!in_array($value, $this->values)) {
      throw new \InvalidArgumentException("Invalid '" . $this->name . "' value.");
    }

    return $value;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function requiresSQLCommentHint(AbstractPlatform $platform): bool
  {
    return true;
  }
}
