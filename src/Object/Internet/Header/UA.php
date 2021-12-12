<?php

namespace DevCoding\Object\Internet\Header;

use DevCoding\Object\Internet\Browser\UserAgentBrand;
use DevCoding\Object\System\Version\VersionImmutable;

/**
 * Object representing a Sec-CH-UA header.
 *
 * @see     https://wicg.github.io/ua-client-hints/#iana-ua
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 *
 * @package DevCoding\Object\Internet\Header
 */
class UA extends AbstractHeader
{
  /** @var string[] Array of known brand strings */
  const KNOWN = ['Chrome', 'Chromium', 'Edge', 'Edg', 'Firefox', 'Safari', 'Opera'];
  /** @var string The key for this header */
  const KEY = 'Sec-CH-UA';

  /** @var UserAgentBrand[] An array of brand objects, parsed from this header's value */
  protected $brands;

  /**
   * @return string
   */
  public function getString()
  {
    return $this->value;
  }

  /**
   * Evaluates whether the given string is present in the User Agent Brand list.
   *
   * @param string $string
   *
   * @return bool
   */
  public function isBrandName($string)
  {
    foreach ($this->getBrands() as $brand)
    {
      if ($brand->isName($string))
      {
        return true;
      }
    }

    return false;
  }

  /**
   * Returns an array of UserAgentBrand objects, present within this header's value.
   *
   * @return UserAgentBrand[]|null
   */
  public function getBrands()
  {
    if (!isset($this->brands))
    {
      if ($m = $this->getBrandMatches($this->value))
      {
        $this->brands = [];
        foreach ($m as $set)
        {
          $this->brands[] = new UserAgentBrand(trim($set['brand']), $set['version']);
        }
      }
    }

    return $this->brands;
  }

  /**
   * Returns the dominant major version number, parsed from this header's value.
   *
   * @return int|null
   */
  public function getVersion()
  {
    return ($v = $this->getCommonVersion()) ? $v->getMajor() : null;
  }

  /**
   * Parses the given string, returning an array of array that contain a 'brand' and 'version' string.
   *
   * @param string $string
   *
   * @return array[]|null
   */
  protected function getBrandMatches($string)
  {
    $m = [];
    if (preg_match_all('/(?<brand>[^"]+)\";\s?v="(?<version>[^"]+)",?/', $string, $m, PREG_SET_ORDER))
    {
      return $m;
    }

    return null;
  }

  /**
   * Returns the most common version contained with the UserAgentBrand objects parsed from this header's value.  If
   * no version within the UA repeats, returns the first value.
   *
   * @return VersionImmutable|null
   */
  protected function getCommonVersion()
  {
    foreach ($this->getBrands() as $brand)
    {
      $versions[] = (string) $brand->getVersion();
    }

    if (!empty($versions))
    {
      // Prefer the most common value
      if ($v = $this->getCommonValue($versions))
      {
        return new VersionImmutable($v);
      }

      // If no common value, default to the first value from a known Client UA Brand
      foreach ($this->getBrands() as $brand)
      {
        if (in_array($brand->getName(), static::KNOWN))
        {
          return $brand->getVersion();
        }
      }
    }

    return null;
  }

  /**
   * Returns the most popular value from the given array.
   *
   * @param array $arr
   *
   * @return int|string|null
   */
  private function getCommonValue($arr)
  {
    // Get count of each version number represented
    $counts = array_count_values($arr);
    // Sort the counted values
    arsort($counts);
    // Only valid if it's more than 1
    if (reset($counts) > 1)
    {
      $keys = array_slice(array_keys($counts), 0, 1, true);

      return array_shift($keys);
    }

    return null;
  }

  /**
   * @return string[]
   */
  protected function getKeys()
  {
    return [static::KEY];
  }
}
