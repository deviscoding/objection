<?php

namespace DevCoding\Helper;

/**
 * Helper class for normalization and evaluation of boolean values.
 *
 * @method static BooleanHelper get()
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 * @package DevCoding\Helper
 */
class BooleanHelper
{
  use SingletonTrait;

  /**
   * Attempts to resolve the given data into an int value.  If the value is an object with a __toString method, it is
   * converted to a string.  If the value is a string or float representing a whole number, it is changed to the int
   * type then returned.  If the value does not represent an integer, then NULL is returned.
   *
   * @param mixed $data
   *
   * @return bool|null
   */
  public function toBoolean($data)
  {
    if (!is_bool($data))
    {
      if ($this->isTrue($data))
      {
        return true;
      }
      elseif ($this->isFalse($data))
      {
        return false;
      }

      throw new \Exception('This value cannot be converted to a boolean.');
    }

    return $data;
  }

  public function isBoolable($value)
  {
    if (!is_bool($value))
    {
      if (!is_scalar($value) && $this->isStringable($value))
      {
        // Convert to string from object
        $value = (string) $value;
      }

      return $this->isTrueValue($value) || $this->isFalseValue($value);
    }

    return true;
  }

  public function isTrue($value)
  {
    return true === $value || ($this->isStringable($value) && $this->isTrueValue((string) $value));
  }

  public function isFalse($value)
  {
    return true === $value || ($this->isStringable($value) && $this->isFalseValue((string) $value));
  }

  public function toInt(bool $boolean)
  {
    return $boolean ? 1 : 0;
  }

  public function toString(bool $boolean)
  {
    return $boolean ? 'true' : 'false';
  }

  protected function isTrueValue($value)
  {
    return true === $value || in_array($value, ['true', 'yes', 'y', '1', 1]);
  }

  protected function isFalseValue($value)
  {
    /* @noinspection ALL */
    return false === $value || in_array($value, ['false', 'no', 'n', '0', 0]);
  }

  protected function isStringable($value)
  {
    return StringHelper::get()->isStringable($value);
  }
}
