<?php

namespace DevCoding\Object\System;

/**
 * Object representing the pointer on a device.
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 * @package DevCoding\Object\System
 */
class Pointer
{
  /** @var string The primary input mechanism includes an accurate pointing device. */
  const FINE = 'fine';
  /** @var string The primary input mechanism includes a pointing device of limited accuracy. */
  const COARSE = 'coarse';
  /** @var string The primary input mechanism cannot be identified. */
  const INCONCLUSIVE = 'inconclusive';
  /** @var string The primary input mechanism does not include a pointing device. */
  const NONE = 'none';

  /** @var string The type of pointer: fine, coarse, none, or inconclusive */
  protected $type;
  /** @var bool If known; whether the device also has touch capabilities */
  protected $touch;
  /** @var bool If known; whether the device is using Windows 8's Metro Mode (full screen mode) */
  protected $metro;

  /**
   * @param string $type  One of the class constants
   * @param bool   $touch If known; whether the device also has touch capabilities
   * @param bool   $metro If known; whether the device is using Windows 8's Metro Mode (full screen mode)
   */
  public function __construct($type, $touch = true, $metro = false)
  {
    $this->type  = $type;
    $this->touch = $touch;
    $this->metro = $metro;
  }

  /**
   * Returns the type of pointer as a string: fine, coarse, none, or inconclusive.
   *
   * @return string
   */
  public function getType(): string
  {
    return $this->type;
  }

  /**
   * @return bool
   */
  public function isCoarse()
  {
    return 'coarse' === $this->getType();
  }

  /**
   * @return bool
   */
  public function isFine()
  {
    return 'fine' === $this->getType();
  }

  /**
   * @return bool
   */
  public function isTouch()
  {
    return $this->touch;
  }

  /**
   * @return bool
   */
  public function isMetro()
  {
    return $this->metro;
  }
}
