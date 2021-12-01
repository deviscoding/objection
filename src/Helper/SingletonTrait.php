<?php

namespace DevCoding\Helper;

/**
 * Trait to easily make a helper class into a singleton instance.  Should be used sparingly.
 *
 * @package DevCoding\Helper
 */
trait SingletonTrait
{
  /** @var static */
  protected static $instance;

  /**
   * Returns an instance of the class, creating an instance if one is not already available.
   *
   * @return static
   */
  public static function get()
  {
    if (empty(static::$instance))
    {
      static::$instance = new static();
    }

    return static::$instance;
  }
}
