<?php

namespace DevCoding\Object\Type;

use DevCoding\Helper\StringHelper;

/**
 * Object representing a string, which can be used as a string in most instances.  Contains convenient methods for
 * modifying the string before output.
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 * @package DevCoding\Object\Type
 */
class StringLiteral
{
  /** @var string */
  private $value;

  public function __construct(string $value)
  {
    $this->value = $value;
  }

  // region //////////////////////////////////////////////// Value Object Methods

  /**
   * @return string
   */
  public function __toString(): string
  {
    return $this->toNative();
  }

  /**
   * Determines if the given value is the equivalent of the given string.
   *
   * @param mixed $value
   */
  public function equals($value): bool
  {
    if ($value instanceof StringLiteral)
    {
      $string = $value->toNative();
    }
    elseif (StringHelper::get()->isStringable($value))
    {
      $string = (string) $value;
    }

    return isset($string) && $string == $this->toNative();
  }

  /**
   * Returns a StringLiteral object from the given value.
   *
   * @param string $val
   */
  public static function fromNative($val): StringLiteral
  {
    return new static($val);
  }

  /**
   * Returns a StringLiteral generated with "random" characters.
   *
   * @param int $length
   *
   * @throws \Exception if length is over 32 characters
   */
  public static function fromRandom($length): StringLiteral
  {
    if ($length > 32)
    {
      throw new \Exception('Max length of random string is 32.');
    }

    $string = substr(md5(rand(100000, 999999)), 0, $length);

    return new static($string);
  }

  /**
   * @return string
   */
  public function toNative()
  {
    return $this->value;
  }

  // endregion ///////////////////////////////////////////// End Value Object Methods

  // region //////////////////////////////////////////////// Other Public Methods

  /**
   * Converts this string into a CSS safe string that may be used for CSS class names or HTML5 IDs.
   *
   * @param string $sep             The separator to use.  Defaults to -
   * @param bool   $spaces          Allow spaces in the result.  Defaults to FALSE
   * @param bool   $force_lowercase Force the result to lowercase.  Defaults to FALSE
   *
   * @return string|string[]|null
   *
   * @throws \Exception
   */
  public function css($sep = '-', $spaces = false, $force_lowercase = false)
  {
    // Replace all accent characters with their non-accented equivalents.
    $string = $this->transliterate();

    // Replace Spaces
    $add    = ($spaces) ? ['\s', preg_quote($sep, '/')] : [null, preg_quote($sep, '/')];
    $regex  = vsprintf('/([^a-zA-Z0-9_%s%s]+)/', $add);
    $string = preg_replace($regex, $sep, $string);

    // Force Lowercase
    if ($force_lowercase)
    {
      $string = strtolower($string);
    }

    // Make sure first character is NOT a number.
    if (is_numeric(substr($string, 0, 1)))
    {
      $digits = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
      $string = $digits[substr($string, 0, 1)].substr($string, 1);
    }

    return $string;
  }

  /**
   * Converts this string into the proper format for a PHP class name. IE- Converts 'table name' to 'TableName'.
   *
   * @param bool $transliterate whether to replace non-ASCII characters with non-accented equivalents where possible
   *
   * @return string
   *
   * @author Jonathan H. Wage <jonwage@gmail.com> (Borrowed from Doctrine Inflector)
   */
  public function classify($transliterate = true)
  {
    $word = ($transliterate) ? $this->transliterate() : $this->toNative();

    return str_replace([' ', '_', '-'], '', ucwords($word, ' _-'));
  }

  /**
   * Converts this string into camelCase. IE- Converts 'table name' to 'tableName'.
   *
   * @param bool $transliterate
   *
   * @author Jonathan H. Wage <jonwage@gmail.com> (Borrowed from Doctrine Inflector)
   *
   * @return string
   */
  public function camelize($transliterate = true)
  {
    return lcfirst($this->classify($transliterate));
  }

  /**
   * Creates a "slug" from this string by optionally any non ASCII characters, then replacing all the spacing
   * characters with a separator, converting the string to lower case, and removing any non-alphanumeric characters.
   *
   * @param string $sep           the separator to use, a dash by default
   * @param bool   $transliterate Whether to replace non-ASCII accented characters with non-accented equivalents.
   *                              If this option is FALSE, all non-ASCII characters are simply removed.
   *
   * @return string
   *
   * @throws \Exception
   */
  public function slugify($sep = '-', $transliterate = true)
  {
    $string = ($transliterate) ? $this->transliterate() : $this->toNative();

    return strtolower(trim(preg_replace('~[^0-9a-z]+~i', $sep, $string)));
  }

  /**
   * Removes and replaces accent characters, using the transliterator_transliterate function if possible.
   *
   * @return string the transliterated word or phrase
   */
  public function transliterate()
  {
    try
    {
      if (function_exists('transliterator_transliterate'))
      {
        /* @noinspection PhpComposerExtensionStubsInspection */
        return transliterator_transliterate('Any-Latin; Latin-ASCII', $this->toNative());
      }
    }
    catch (\Exception $e)
    {
      // Proceed with the transliteration using the array of regex patterns and replacements below.
    }

    $string           = $this->toNative();
    $transliterations = [
      // Alphabetical
      '/À/' => 'A',       '/Á/' => 'A',       '/Â/' => 'A',       '/Ã/' => 'A',       '/Ä/' => 'Ae',
      '/Å/' => 'A',       '/Ā/' => 'A',       '/Ą/' => 'A',       '/Ă/' => 'A',       '/Æ/' => 'Ae',
      '/Ç/' => 'C',       '/Ć/' => 'C',       '/Č/' => 'C',       '/Ĉ/' => 'C',       '/Ċ/' => 'C',
      '/Ď/' => 'D',       '/Đ/' => 'D',       '/Ð/' => 'D',       '/È/' => 'E',       '/É/' => 'E',
      '/Ê/' => 'E',       '/Ë/' => 'E',       '/Ē/' => 'E',       '/Ę/' => 'E',       '/Ě/' => 'E',
      '/Ĕ/' => 'E',       '/Ė/' => 'E',       '/Ĝ/' => 'G',       '/Ğ/' => 'G',       '/Ġ/' => 'G',
      '/Ģ/' => 'G',       '/Ĥ/' => 'H',       '/Ħ/' => 'H',       '/Ì/' => 'I',       '/Í/' => 'I',
      '/Î/' => 'I',       '/Ï/' => 'I',       '/Ī/' => 'I',       '/Ĩ/' => 'I',       '/Ĭ/' => 'I',
      '/Į/' => 'I',       '/İ/' => 'I',       '/Ĳ/' => 'Ij',      '/Ĵ/' => 'J',       '/Ķ/' => 'K',
      '/Ł/' => 'L',       '/Ľ/' => 'L',       '/Ĺ/' => 'L',       '/Ļ/' => 'L',       '/Ŀ/' => 'L',
      '/Ñ/' => 'N',       '/Ń/' => 'N',       '/Ň/' => 'N',       '/Ņ/' => 'N',       '/Ŋ/' => 'N',
      '/Ò/' => 'O',       '/Ó/' => 'O',       '/Ô/' => 'O',       '/Õ/' => 'O',       '/Ö/' => 'Oe',
      '/Ø/' => 'O',       '/Ō/' => 'O',       '/Ő/' => 'O',       '/Ŏ/' => 'O',       '/Œ/' => 'Oe',
      '/Ŕ/' => 'R',       '/Ř/' => 'R',       '/Ŗ/' => 'R',       '/Ś/' => 'S',       '/Š/' => 'S',
      '/Ş/' => 'S',       '/Ŝ/' => 'S',       '/Ș/' => 'S',       '/Ť/' => 'T',       '/Ţ/' => 'T',
      '/Ŧ/' => 'T',       '/Ț/' => 'T',       '/Ù/' => 'U',       '/Ú/' => 'U',       '/Û/' => 'U',
      '/Ü/' => 'Ue',      '/Ū/' => 'U',       '/Ů/' => 'U',       '/Ű/' => 'U',       '/Ŭ/' => 'U',
      '/Ũ/' => 'U',       '/Ų/' => 'U',       '/Ŵ/' => 'W',       '/Ý/' => 'Y',       '/Ŷ/' => 'Y',
      '/Ÿ/' => 'Y',       '/Y/' => 'Y',       '/Ź/' => 'Z',       '/Ž/' => 'Z',       '/Ż/' => 'Z',
      '/Þ/' => 'T',
      '/à/' => 'a',       '/á/' => 'a',       '/â/' => 'a',       '/ã/' => 'a',       '/ä/' => 'ae',
      '/å/' => 'a',       '/ā/' => 'a',       '/ą/' => 'a',       '/ă/' => 'a',       '/æ/' => 'ae',
      '/ç/' => 'c',       '/ć/' => 'c',       '/č/' => 'c',       '/ĉ/' => 'c',       '/ċ/' => 'c',
      '/ď/' => 'd',       '/đ/' => 'd',       '/ð/' => 'd',       '/è/' => 'e',       '/é/' => 'e',
      '/ê/' => 'e',       '/ë/' => 'e',       '/ē/' => 'e',       '/ę/' => 'e',       '/ě/' => 'e',
      '/ĕ/' => 'e',       '/ė/' => 'e',       '/ĝ/' => 'g',       '/ğ/' => 'g',       '/ġ/' => 'g',
      '/ģ/' => 'g',       '/ĥ/' => 'h',       '/ħ/' => 'h',       '/ì/' => 'i',       '/í/' => 'i',
      '/î/' => 'i',       '/ï/' => 'i',       '/ī/' => 'i',       '/ĩ/' => 'i',       '/ĭ/' => 'i',
      '/į/' => 'i',       '/ı/' => 'i',       '/ĳ/' => 'ij',      '/ĵ/' => 'j',       '/ķ/' => 'k',
      '/ł/' => 'l',       '/ľ/' => 'l',       '/ĺ/' => 'l',       '/ļ/' => 'l',       '/ŀ/' => 'l',
      '/ñ/' => 'n',       '/ń/' => 'n',       '/ň/' => 'n',       '/ņ/' => 'n',       '/ŋ/' => 'n',
      '/ò/' => 'o',       '/ó/' => 'o',       '/ô/' => 'o',       '/õ/' => 'o',       '/ö/' => 'oe',
      '/ø/' => 'o',       '/ō/' => 'o',       '/ő/' => 'o',       '/ŏ/' => 'o',       '/œ/' => 'oe',
      '/ŕ/' => 'r',       '/ř/' => 'r',       '/ŗ/' => 'r',       '/ś/' => 's',       '/š/' => 's',
      '/ş/' => 's',       '/ŝ/' => 's',       '/ș/' => 's',       '/ť/' => 't',       '/ţ/' => 't',
      '/ŧ/' => 't',       '/ț/' => 't',       '/ù/' => 'u',       '/ú/' => 'u',       '/û/' => 'u',
      '/ü/' => 'ue',      '/ū/' => 'u',       '/ů/' => 'u',       '/ű/' => 'u',       '/ŭ/' => 'u',
      '/ũ/' => 'u',       '/ų/' => 'u',       '/ŵ/' => 'w',       '/ý/' => 'y',       '/ŷ/' => 'y',
      '/ÿ/' => 'y',       '/y/' => 'y',       '/ź/' => 'z',       '/ž/' => 'z',       '/ż/' => 'z',
      '/þ/' => 't',       '/ß/' => 'ss',      '/ſ/' => 'ss',      '/ƒ/' => 'f',       '/ĸ/' => 'k',
      '/ŉ/' => 'n', ];

    foreach ($transliterations as $key => $value)
    {
      $string = preg_replace($key, $value, $string);
    }

    return $string;
  }

  // endregion ///////////////////////////////////////////// End Other Public Methods
}
