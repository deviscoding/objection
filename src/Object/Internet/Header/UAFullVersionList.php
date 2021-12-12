<?php

namespace DevCoding\Object\Internet\Header;

use DevCoding\Object\Internet\Browser\UserAgentBrand;
use DevCoding\Object\System\Version\VersionImmutable;

/**
 * Object representing a Sec-CH-UA-Full-Version-List header.
 *
 * @see     https://wicg.github.io/ua-client-hints/#iana-full-version-list
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 *
 * @package DevCoding\Object\Internet\Header
 */
class UAFullVersionList extends UA
{
  const KEY = 'Sec-CH-UA-Full-Version-List';

  /**
   * Returns an object representing the most common version contained within the header.
   *
   * @return VersionImmutable|null
   */
  public function getVersion()
  {
    return $this->getCommonVersion();
  }

  /**
   * Returns an array of UserAgentBrand objects, as parsed from the header's value.
   *
   * @return array|UserAgentBrand[]
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
          $version        = new VersionImmutable($set['version']);
          $this->brands[] = new UserAgentBrand(trim($set['brand']), (string) $version);
        }
      }
    }

    return $this->brands;
  }
}
