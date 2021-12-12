<?php

namespace DevCoding\Object\Internet\Header;

use DevCoding\Object\Internet\HeaderBag;

abstract class AbstractHeader
{
  /** @var string */
  protected $value;

  public function __construct(string $value)
  {
    $this->value = $value;
  }

  /**
   * @return string
   */
  public function __toString()
  {
    return $this->value ?? '';
  }

  /**
   * @return array
   */
  abstract protected function getKeys();

  /**
   * @return AbstractHeader
   */
  public static function fromHeaders()
  {
    return static::fromHeaderBag(new HeaderBag());
  }

  /**
   * @return AbstractHeader
   *
   * @throws \ReflectionException
   */
  public static function fromHeaderBag(HeaderBag $HeaderBag)
  {
    $rc = new \ReflectionClass(get_class());
    $ob = $rc->newInstanceWithoutConstructor();

    return new static($HeaderBag->resolve($ob->getKeys()));
  }
}
