<?php

namespace DevCoding\Object\Internet\Browser;

use DevCoding\Object\System\Version\VersionImmutable;

/**
 * Object representing a Client UA Brand.
 *
 * @see     https://wicg.github.io/ua-client-hints/#user-agent-brand
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 *
 * @package DevCoding\Object\Internet\Browser
 */
class UserAgentBrand
{
  /** @var string */
  protected $name;
  /** @var VersionImmutable */
  protected $version;

  /**
   * @param string                  $name
   * @param VersionImmutable|string $version
   */
  public function __construct(string $name, $version)
  {
    $this->name    = $name;
    $this->version = $version instanceof VersionImmutable ? $version : new VersionImmutable((string) $version);
  }

  /**
   * @return string
   */
  public function __toString()
  {
    return $this->getName();
  }

  /**
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * @return VersionImmutable
   */
  public function getVersion(): VersionImmutable
  {
    return $this->version;
  }

  /**
   * @param string $name
   *
   * @return bool
   */
  public function isName($name)
  {
    return strtolower($name) == strtolower($this->getName());
  }
}
