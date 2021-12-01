<?php

namespace DevCoding\Helper;

/**
 * Helper that includes various string functions that do not belong in the StringLiteral object.
 *
 * @method static StringHelper get()
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 * @package DevCoding\Helper
 */
class StringHelper
{
  use SingletonTrait;

  /**
   * Evaluates whether the given value can be cast to a string without error.
   *
   * @param mixed $val the value to evaluate
   *
   * @return bool TRUE if the value may be safely cast to a string
   */
  public function isStringable($val)
  {
    return is_scalar($val) || is_object($val) && method_exists($val, '__toString');
  }
}
