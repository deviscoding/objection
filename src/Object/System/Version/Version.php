<?php

namespace DevCoding\Object\System\Version;

/**
 * Mutable object class representing a semantic software version, adding setter methods to BaseVersion.
 *
 * This class is based loosely on PHLAK's SemVer (https://github.com/PHLAK/SemVer), however the parser has been
 * rewritten to be more forgiving with version numbers that do not quite match the Semantic Versioning strategy,
 * include the build number when making comparisons, and provide separate classes for immutable version objects.
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 * @package DevCoding\Object\System\Version
 */
class Version extends BaseVersion
{
  /**
   * @param int $major
   */
  public function setMajor($major): Version
  {
    $this->major = $major;

    return $this;
  }

  /**
   * @param int $minor
   */
  public function setMinor($minor): Version
  {
    $this->minor = $minor;

    return $this;
  }

  /**
   * @param int $patch
   */
  public function setPatch($patch): Version
  {
    $this->patch = $patch;

    return $this;
  }

  /**
   * @param string $pre
   */
  public function setPreRelease($pre): Version
  {
    $this->pre = $pre;

    return $this;
  }

  /**
   * @param string $build
   */
  public function setBuild($build): Version
  {
    $this->build = $build;

    return $this;
  }
}
