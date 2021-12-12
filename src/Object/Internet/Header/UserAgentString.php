<?php

namespace DevCoding\Object\Internet\Header;

/**
 * Object representing a User-Agent header.
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 *
 * @package DevCoding\Object\Internet\Header
 */
class UserAgentString extends AbstractHeader
{
  const BOTS = [
      'crawler', 'bot', 'spider', 'archiver', 'scraper', 'stripper', 'wget', 'curl', 'AppEngine-Google',
      'AdsBot-Google', 'AdsBot-Google-Mobile-Apps', 'Mediapartners-Google', 'Slurp', 'facebookexternalhit',
      'Zeus 32297 Webster Pro', '008', 'PagePeeker', 'Nutch', 'grub-client', 'NewsGator', 'Yandex',
  ];

  const HEADERS = [
      'USER_AGENT',
      'X_OPERAMINI_PHONE_UA',
      'X_DEVICE_USER_AGENT',
      'X_ORIGINAL_USER_AGENT',
      'X_SKYFIRE_PHONE',
      'X_BOLT_PHONE_UA',
      'DEVICE_STOCK_UA',
      'X_UCBROWSER_DEVICE_UA',
  ];

  public function isBot()
  {
    return $this->isMatch(sprintf('#(%s)#i', implode('|', static::BOTS)));
  }

  public function isMatch($inc, $exc = null, &$matches = [])
  {
    if (!empty($this->_ua))
    {
      if (preg_match($inc, (string) $this, $matches))
      {
        if (empty($exc) || !preg_match($exc, (string) $this))
        {
          return true;
        }
      }
    }

    return false;
  }

  /**
   * @param string        $inc        Regex Pattern to match this browser, including delimiters and options
   * @param string|null   $exc        Optional Regex Pattern of exclusions, including delimiters and options
   * @param \Closure|null $normalizer Normalizer for regex matches.  Must return an array.
   *
   * @return array|bool
   */
  public function getMatches($inc, $exc = null, $normalizer = null)
  {
    $matches = [];
    if ($this->isMatch($inc, $exc, $matches))
    {
      if ($normalizer instanceof \Closure)
      {
        return $normalizer($matches);
      }
      else
      {
        return $matches;
      }
    }

    return false;
  }

  /**
   * @return string[]
   */
  protected function getKeys()
  {
    return static::HEADERS;
  }
}
