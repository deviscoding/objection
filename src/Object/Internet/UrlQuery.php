<?php

namespace DevCoding\Object\Internet;

/**
 * Immutable Object representing a query string of URL.
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 *
 * @package DevCoding\Object\Internet
 */
class UrlQuery
{
  /** @var string */
  protected $raw;
  /** @var array */
  protected $parsed;

  // region //////////////////////////////////////////////// Object Creation Methods

  /**
   * @param string $raw
   */
  public function __construct($raw)
  {
    $this->raw = $raw;
  }

  /**
   * Creates a UrlQuery from an array.
   *
   * @return UrlQuery
   */
  public static function fromArray(array $array)
  {
    $UrlQuery = new UrlQuery('');
    $str      = $UrlQuery->getStringFrom($array);

    return new UrlQuery($str);
  }

  /**
   * Determines if the given criteria matches this UrlQuery.  If a string or array are given, these are normalized into
   * a UrlQuery before comparing.  All comparisons are made strictly using the string output.
   *
   * @param UrlQuery|string|array $value
   */
  public function equals($value): bool
  {
    $str = '';
    if ($value instanceof UrlQuery)
    {
      $str = (string) $this;
    }
    elseif (is_array($value))
    {
      $str = UrlQuery::fromArray($value)->__toString();
    }
    elseif (is_string($value))
    {
      $str = (new UrlQuery($value))->__toString();
    }

    return $str === (string) $this;
  }

  // endregion ///////////////////////////////////////////// End Object Creation Methods

  // region //////////////////////////////////////////////// Public Getters

  /**
   * Returns the url query in the form of an array.  Nested arguments (arg[]=1&arg[]=2) are nested arrays.
   *
   * @return array
   */
  public function toArray()
  {
    if (!isset($this->parsed))
    {
      $this->doParse($this->raw);
    }

    return $this->parsed;
  }

  public function __toString(): string
  {
    try
    {
      if (!isset($this->parsed))
      {
        $this->doParse($this->raw);
      }

      return $this->getStringFrom($this->parsed);
    }
    catch (\Exception $e)
    {
      return $this->raw;
    }
  }

  /**
   * Returns the value of the given key in this UrlQuery.
   *
   * @param string $key The key to return the value of
   *
   * @return mixed The value of the given key
   *
   * @throws \Exception If the key cannot be found in the UrlQuery
   */
  public function get($key)
  {
    if ($this->has($key))
    {
      return $this->parsed[$key];
    }

    throw new \Exception(sprintf('The key "%s" was not found in this UrlQuery object.', $key));
  }

  /**
   * @param string $key The key to check for
   *
   * @return bool TRUE if this UrlQuery contains the given key
   */
  public function has($key)
  {
    if (!isset($this->parsed))
    {
      $this->doParse($this->raw);
    }

    return isset($this->parsed[$key]);
  }

  // endregion ///////////////////////////////////////////// End Public Getters

  // region //////////////////////////////////////////////// Helper Methods

  /**
   * Parses the url query string into an array using the php function parse_str.  In the event of a parsing error,
   * an empty array if returned.
   *
   * @param string $query
   */
  protected function doParse($query)
  {
    $retval = [];
    @parse_str($query, $retval);

    $this->parsed = !empty($retval) ? $retval : [];
  }

  /**
   * Turns the given array into a URL query string. Nested arrays are turned into PHP-Style arguments (arg[]=1&arg[]=2).
   *
   * @param array $arr  The array of values.  The top level array must be associative, any subarrays must not.
   * @param null  $pKey Any prefixed key.  This indicates that the array of values is part of a nested array.
   *
   * @return string the url query string
   */
  protected function getStringFrom($arr, $pKey = null)
  {
    $str = '';
    foreach ($arr as $key => $value)
    {
      $pre  = !empty($str) ? '&' : '';
      $rKey = ($pKey) ? $pKey.'[]' : $key;
      if (is_array($value))
      {
        $str .= $pre.$this->getStringFrom($value, $rKey);
      }
      else
      {
        $str .= sprintf('%s%s=%s', $pre, $rKey, $value);
      }
    }

    return $str;
  }

  // endregion ///////////////////////////////////////////// End Helper Methods
}
