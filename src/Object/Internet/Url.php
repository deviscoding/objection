<?php
/**
 * Url.php.
 */

namespace DevCoding\Object\Internet;

use DevCoding\Object\Type\StringLiteral;

/**
 * Immutable Object representing an Url.
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 * @package DevCoding\Object\Internet
 */
class Url
{
  /** @var string */
  protected $raw;
  /** @var array */
  protected $parts;
  /** @var UrlQuery */
  protected $query;

  // region //////////////////////////////////////////////// Object Instantiation Methods

  /**
   * @param string $raw
   */
  public function __construct($raw)
  {
    $this->raw = $raw;
  }

  // endregion ///////////////////////////////////////////// End Object Instantiation Methods

  // region //////////////////////////////////////////////// Public Getters

  /**
   * Determines if the given value is equal to this URL by performing a comparison of the string form of this object.
   *
   * If the given value is a string, it is converted to an Url object for comparison.
   *
   * @param Url|StringLiteral|string $value
   */
  public function equals($value): bool
  {
    if ($value instanceof Url || $value instanceof StringLiteral)
    {
      $str = $value->toNative();
    }
    elseif (is_string($value))
    {
      $str = (new Url($value))->__toString();
    }
    else
    {
      return false;
    }

    return $str === $this->__toString();
  }

  /**
   * Returns any URL fragment (the portion after the #) as a StringLiteral.
   *
   * @return StringLiteral|null
   */
  public function getFragment()
  {
    if (empty($this->parts))
    {
      $this->doParse($this->raw);
    }

    return isset($this->parts[PHP_URL_FRAGMENT]) ? new StringLiteral($this->parts[PHP_URL_FRAGMENT]) : null;
  }

  /**
   * Returns any URL host as a StringLiteral.
   *
   * @return StringLiteral|null
   */
  public function getHost()
  {
    if (empty($this->parts))
    {
      $this->doParse($this->raw);
    }

    return isset($this->parts[PHP_URL_HOST]) ? new StringLiteral($this->parts[PHP_URL_HOST]) : null;
  }

  /**
   * Returns any password embedded in the URL.
   *
   * @return string|null
   */
  public function getPass()
  {
    if (empty($this->parts))
    {
      $this->doParse($this->raw);
    }

    return $this->parts[PHP_URL_PASS];
  }

  /**
   * Returns the path from the URL as a StringLiteral object.  A File object was not used here because the File class
   * strips the trailing slash from /app_dev.php/.
   *
   * @return StringLiteral|null
   */
  public function getPath()
  {
    if (empty($this->parts))
    {
      $this->doParse($this->raw);
    }

    return isset($this->parts[PHP_URL_PATH]) ? new StringLiteral($this->parts[PHP_URL_PATH]) : null;
  }

  /**
   * Returns any port referenced in the URL.  Defaults to null if no port is present.
   *
   * @return int|null
   */
  public function getPort()
  {
    if (empty($this->parts))
    {
      $this->doParse($this->raw);
    }

    return $this->parts[PHP_URL_PORT];
  }

  /**
   * Returns the UrlQuery from the URL.
   *
   * @return UrlQuery|null
   */
  public function getQuery()
  {
    if (empty($this->query))
    {
      if (empty($this->parts))
      {
        $this->doParse($this->raw);
      }

      if (isset($this->parts[PHP_URL_QUERY]))
      {
        $this->query = new UrlQuery($this->parts[PHP_URL_QUERY]);
      }
    }

    return $this->query;
  }

  /**
   * Returns the scheme referenced in the URL as a StringLiteral, or null if no scheme was specified.
   *
   * @return StringLiteral|null
   */
  public function getScheme()
  {
    if (empty($this->parts))
    {
      $this->doParse($this->raw);
    }

    return isset($this->parts[PHP_URL_SCHEME]) ? new StringLiteral($this->parts[PHP_URL_SCHEME]) : null;
  }

  /**
   * Returns any username in the URL as a StringLiteral, or null if no user was specified.
   *
   * @return StringLiteral|null
   */
  public function getUser()
  {
    if (empty($this->parts))
    {
      $this->doParse($this->raw);
    }

    return isset($this->parts[PHP_URL_USER]) ? new StringLiteral($this->parts[PHP_URL_USER]) : null;
  }

  /**
   * Returns this Url object as a string by compiling the parts together.  If an exception is thrown, the raw string
   * from object creation is returned.
   */
  public function __toString(): string
  {
    try
    {
      $url = '';
      if ($scheme = $this->getScheme())
      {
        $url .= $scheme.'://';
      }

      if ($user = $this->getUser())
      {
        $pass = ($pw = $this->getPass()) ? ':'.$pw : '';
        $url .= $user.$pass.'@';
      }

      if ($host = $this->getHost())
      {
        $url .= $host;
      }

      if ($port = $this->getPort())
      {
        $url .= ':'.$port;
      }

      if ($path = $this->getPath())
      {
        $url .= $path;
      }

      if ($query = $this->getQuery())
      {
        $url .= '?'.$query;
      }

      if ($frag = $this->getFragment())
      {
        $url .= '#'.$frag;
      }

      return $url;
    }
    catch (\Exception $e)
    {
      return $this->raw;
    }
  }

  // endregion ///////////////////////////////////////////// End Public Getters

  // region //////////////////////////////////////////////// Helper Methods

  /**
   * Parses the given string into it's parts, populating this object.
   *
   * @param string $string
   *
   * @return $this
   */
  protected function doParse($string)
  {
    $parsed = parse_url($string);

    $this->parts = [
        PHP_URL_SCHEME   => $parsed['scheme'] ?? null,
        PHP_URL_HOST     => $parsed['host'] ?? null,
        PHP_URL_PORT     => isset($parsed['port']) ? (int) $parsed['port'] : null,
        PHP_URL_USER     => $parsed['user'] ?? null,
        PHP_URL_PASS     => $parsed['pass'] ?? null,
        PHP_URL_PATH     => $parsed['path'] ?? null,
        PHP_URL_QUERY    => $parsed['query'] ?? null,
        PHP_URL_FRAGMENT => $parsed['fragment'] ?? null,
    ];

    return $this;
  }

  // endregion ///////////////////////////////////////////// End Helper Methods
}
