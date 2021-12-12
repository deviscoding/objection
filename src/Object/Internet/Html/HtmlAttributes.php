<?php
/**
 * HtmlAttributes.php.
 */

namespace DevCoding\Object\Internet\Html;

use DevCoding\Helper\BooleanHelper;
use DevCoding\Object\Internet\Url;

/**
 * Represents an array of HTML5 Attributes for an HTML5 element, and contains convenience methods for output.
 *
 * Class HtmlAttributes
 *
 * @method string         getAccept()
 * @method string         getAcceptCharset()
 * @method string         getAccesskey()
 * @method string         getAction()
 * @method string         getAlign()
 * @method string         getAllow()
 * @method string         getAlt()
 * @method string         getAsync()
 * @method bool           getAutocapitalize()
 * @method bool           getAutocomplete()
 * @method string         getAutofocus()
 * @method string         getAutoplay()
 * @method string         getBackground()
 * @method string         getBgcolor()
 * @method string         getBorder()
 * @method string         getBuffered()
 * @method string         getCapture()
 * @method string         getChallenge()
 * @method string         getCharset()
 * @method bool           getChecked()
 * @method string         getCite()
 * @method string         getCode()
 * @method string         getCodebase()
 * @method string         getColor()
 * @method string         getCols()
 * @method string         getColspan()
 * @method string         getContent()
 * @method string         getContenteditable()
 * @method string         getContextmenu()
 * @method string         getControls()
 * @method string         getCoords()
 * @method string         getCrossorigin()
 * @method string         getCsp()
 * @method string         getData()
 * @method string         getDatetime()
 * @method string         getDecoding()
 * @method string         getDefault()
 * @method string         getDefer()
 * @method string         getDir()
 * @method string         getDirname()
 * @method bool           getDisabled()
 * @method string         getDownload()
 * @method bool           getDraggable()
 * @method string         getEnctype()
 * @method string         getEnterkeyhint()
 * @method string         getFor()
 * @method string         getForm()
 * @method string         getFormaction()
 * @method string         getFormenctype()
 * @method string         getFormmethod()
 * @method string         getFormnovalidate()
 * @method string         getFormtarget()
 * @method string         getHeaders()
 * @method string         getHeight()
 * @method string         getHidden()
 * @method string         getHigh()
 * @method string         getHref()
 * @method string         getHreflang()
 * @method string         getHttpEquiv()
 * @method string         getIcon()
 * @method string         getId()
 * @method string         getImportance()
 * @method string         getIntegrity()
 * @method string         getIntrinsicsize()
 * @method string         getInputmode()
 * @method string         getIsmap()
 * @method string         getItemprop()
 * @method string         getKeytype()
 * @method string         getKind()
 * @method string         getLabel()
 * @method string         getLang()
 * @method string         getLanguage()
 * @method string         getLoading()
 * @method string         getList()
 * @method string         getLoop()
 * @method string         getLow()
 * @method string         getManifest()
 * @method string         getMax()
 * @method string         getMaxlength()
 * @method string         getMinlength()
 * @method string         getMedia()
 * @method string         getMethod()
 * @method string         getMin()
 * @method string         getMultiple()
 * @method string         getMuted()
 * @method string         getName()
 * @method string         getNovalidate()
 * @method string         getOpen()
 * @method string         getOptimum()
 * @method string         getPattern()
 * @method string         getPing()
 * @method string         getPlaceholder()
 * @method string         getPoster()
 * @method string         getPreload()
 * @method string         getRadiogroup()
 * @method bool           getReadonly()
 * @method string         getReferrerpolicy()
 * @method string         getRel()
 * @method bool           getRequired()
 * @method string         getReversed()
 * @method string         getRows()
 * @method string         getRowspan()
 * @method string         getSandbox()
 * @method string         getScope()
 * @method string         getScoped()
 * @method string         getSelected()
 * @method string         getShape()
 * @method string         getSize()
 * @method string         getSizes()
 * @method string         getSlot()
 * @method string         getSpan()
 * @method bool           getSpellcheck()
 * @method string         getSrc()
 * @method string         getSrcdoc()
 * @method string         getSrclang()
 * @method string         getSrcset()
 * @method string         getStart()
 * @method string         getStep()
 * @method string         getSummary()
 * @method string         getTabindex()
 * @method string         getTarget()
 * @method string         getTitle()
 * @method string         getTranslate()
 * @method string         getType()
 * @method string         getUsemap()
 * @method string         getValue()
 * @method string         getWidth()
 * @method string         getWrap()
 * @method HtmlAttributes setAccept(string $value)
 * @method HtmlAttributes setAcceptCharset(string $value)
 * @method HtmlAttributes setAccesskey(string $value)
 * @method HtmlAttributes setAction(string $value)
 * @method HtmlAttributes setAlign(string $value)
 * @method HtmlAttributes setAllow(string $value)
 * @method HtmlAttributes setAlt(string $value)
 * @method HtmlAttributes setAsync(string $value)
 * @method HtmlAttributes setAutocapitalize(bool $value)
 * @method HtmlAttributes setAutocomplete(bool $value)
 * @method HtmlAttributes setAutofocus(string $value)
 * @method HtmlAttributes setAutoplay(string $value)
 * @method HtmlAttributes setBackground(string $value)
 * @method HtmlAttributes setBgcolor(string $value)
 * @method HtmlAttributes setBorder(string $value)
 * @method HtmlAttributes setBuffered(string $value)
 * @method HtmlAttributes setCapture(string $value)
 * @method HtmlAttributes setChallenge(string $value)
 * @method HtmlAttributes setCharset(string $value)
 * @method HtmlAttributes setChecked(bool $value)
 * @method HtmlAttributes setCite(string $value)
 * @method HtmlAttributes setCode(string $value)
 * @method HtmlAttributes setCodebase(string $value)
 * @method HtmlAttributes setColor(string $value)
 * @method HtmlAttributes setCols(string $value)
 * @method HtmlAttributes setColspan(string $value)
 * @method HtmlAttributes setContent(string $value)
 * @method HtmlAttributes setContenteditable(bool $value)
 * @method HtmlAttributes setContextmenu(string $value)
 * @method HtmlAttributes setControls(string $value)
 * @method HtmlAttributes setCoords(string $value)
 * @method HtmlAttributes setCrossorigin(string $value)
 * @method HtmlAttributes setCsp(string $value)
 * @method HtmlAttributes setData(string $value)
 * @method HtmlAttributes setDatetime(string $value)
 * @method HtmlAttributes setDecoding(string $value)
 * @method HtmlAttributes setDefault(string $value)
 * @method HtmlAttributes setDefer(string $value)
 * @method HtmlAttributes setDir(string $value)
 * @method HtmlAttributes setDirname(string $value)
 * @method HtmlAttributes setDisabled(bool $value)
 * @method HtmlAttributes setDownload(string $value)
 * @method HtmlAttributes setDraggable(bool $value)
 * @method HtmlAttributes setEnctype(string $value)
 * @method HtmlAttributes setEnterkeyhint(string $value)
 * @method HtmlAttributes setFor(string $value)
 * @method HtmlAttributes setForm(string $value)
 * @method HtmlAttributes setFormaction(string $value)
 * @method HtmlAttributes setFormenctype(string $value)
 * @method HtmlAttributes setFormmethod(string $value)
 * @method HtmlAttributes setFormnovalidate(string $value)
 * @method HtmlAttributes setFormtarget(string $value)
 * @method HtmlAttributes setHeaders(string $value)
 * @method HtmlAttributes setHeight(string $value)
 * @method HtmlAttributes setHidden(bool $value)
 * @method HtmlAttributes setHigh(string $value)
 * @method HtmlAttributes setHref(string $value)
 * @method HtmlAttributes setHreflang(string $value)
 * @method HtmlAttributes setHttpEquiv(string $value)
 * @method HtmlAttributes setIcon(string $value)
 * @method HtmlAttributes setId(string $value)
 * @method HtmlAttributes setImportance(string $value)
 * @method HtmlAttributes setIntegrity(string $value)
 * @method HtmlAttributes setIntrinsicsize(string $value)
 * @method HtmlAttributes setInputmode(string $value)
 * @method HtmlAttributes setIsmap(string $value)
 * @method HtmlAttributes setItemprop(string $value)
 * @method HtmlAttributes setKeytype(string $value)
 * @method HtmlAttributes setKind(string $value)
 * @method HtmlAttributes setLabel(string $value)
 * @method HtmlAttributes setLang(string $value)
 * @method HtmlAttributes setLanguage(string $value)
 * @method HtmlAttributes setLoading(string $value)
 * @method HtmlAttributes setList(string $value)
 * @method HtmlAttributes setLoop(string $value)
 * @method HtmlAttributes setLow(string $value)
 * @method HtmlAttributes setManifest(string $value)
 * @method HtmlAttributes setMax(string $value)
 * @method HtmlAttributes setMaxlength(string $value)
 * @method HtmlAttributes setMinlength(string $value)
 * @method HtmlAttributes setMedia(string $value)
 * @method HtmlAttributes setMethod(string $value)
 * @method HtmlAttributes setMin(string $value)
 * @method HtmlAttributes setMultiple(string $value)
 * @method HtmlAttributes setMuted(string $value)
 * @method HtmlAttributes setName(string $value)
 * @method HtmlAttributes setNovalidate(string $value)
 * @method HtmlAttributes setOpen(string $value)
 * @method HtmlAttributes setOptimum(string $value)
 * @method HtmlAttributes setPattern(string $value)
 * @method HtmlAttributes setPing(string $value)
 * @method HtmlAttributes setPlaceholder(string $value)
 * @method HtmlAttributes setPoster(string $value)
 * @method HtmlAttributes setPreload(string $value)
 * @method HtmlAttributes setRadiogroup(string $value)
 * @method HtmlAttributes setReadonly(string $value)
 * @method HtmlAttributes setReferrerpolicy(string $value)
 * @method HtmlAttributes setRel(string $value)
 * @method HtmlAttributes setRequired(bool $value)
 * @method HtmlAttributes setReversed(string $value)
 * @method HtmlAttributes setRows(string $value)
 * @method HtmlAttributes setRowspan(string $value)
 * @method HtmlAttributes setSandbox(string $value)
 * @method HtmlAttributes setScope(string $value)
 * @method HtmlAttributes setScoped(string $value)
 * @method HtmlAttributes setSelected(string $value)
 * @method HtmlAttributes setShape(string $value)
 * @method HtmlAttributes setSize(string $value)
 * @method HtmlAttributes setSizes(string $value)
 * @method HtmlAttributes setSlot(string $value)
 * @method HtmlAttributes setSpan(string $value)
 * @method HtmlAttributes setSpellcheck(bool $value)
 * @method HtmlAttributes setSrc(string $value)
 * @method HtmlAttributes setSrcdoc(string $value)
 * @method HtmlAttributes setSrclang(string $value)
 * @method HtmlAttributes setSrcset(string $value)
 * @method HtmlAttributes setStart(string $value)
 * @method HtmlAttributes setStep(string $value)
 * @method HtmlAttributes setSummary(string $value)
 * @method HtmlAttributes setTabindex(string $value)
 * @method HtmlAttributes setTarget(string $value)
 * @method HtmlAttributes setTitle(string $value)
 * @method HtmlAttributes setTranslate(string $value)
 * @method HtmlAttributes setType(string $value)
 * @method HtmlAttributes setUsemap(string $value)
 * @method HtmlAttributes setValue(string $value)
 * @method HtmlAttributes setWidth(string $value)
 * @method HtmlAttributes setWrap(string $value)
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 * @package DevCoding\Object\Internet\Html
 */
class HtmlAttributes
{
  const URLS = [
      'link', 'href', 'src', 'action', 'data', 'codebase', 'cite', 'background',
      'longdesc', 'profile', 'usemap', 'classid', 'icon', 'formaction', 'poster',
  ];
  protected $_data   = [];
  protected $special = ['class' => 'Class', 'style' => 'Style'];

  // region //////////////////////////////////////////////// Instantiation Methods

  /**
   * Constructor that uses the 'set' method to ensure that the correct setter is used for the given data.
   *
   * @param array $data Array of attribute => value. Values must be boolean/scalar unless an explicit setter exists.
   */
  public function __construct(array $data)
  {
    foreach ($data as $key => $value)
    {
      $this->set($key, $value);
    }
  }

  /**
   * Convenience method for instantiating from an array.
   *
   * @return HtmlAttributes
   */
  public static function fromArray(array $array)
  {
    return new HtmlAttributes($array);
  }

  // endregion ///////////////////////////////////////////// End Instantiation Methods

  // region //////////////////////////////////////////////// Getter/Setter Methods

  /**
   * Allows for getX, setX, and hasX methods for all HTML5 attribute properties, if the property does not have its own
   * methods within this class.
   *
   * @param string $name
   * @param array  $arguments
   *
   * @return bool|mixed|HtmlAttributes|null
   */
  public function __call($name, $arguments)
  {
    if (preg_match('/^(has|get|set)(data)?(.*)$/i', $name, $m))
    {
      $prefix   = strtolower($m[1]);
      $property = (!empty($m[2])) ? strtolower($m[2].'-'.$m[3]) : strtolower($m[3]);

      if ('get' === $prefix)
      {
        return $this->get($property);
      }
      elseif ('has' === $prefix)
      {
        return $this->has($property);
      }
      elseif ('set' === $prefix)
      {
        $arg = reset($arguments);

        return $this->set($property, $arg);
      }
    }

    throw new \BadMethodCallException(sprintf('The method %s does not exist in %s.', $name, __CLASS__));
  }

  /**
   * Adds one or more CSS classes to the class attribute.  Classes may be a string or an array of strings.
   *
   * @param array|string $class the class or classes to add to the class attribute
   *
   * @return $this
   */
  public function addClass($class)
  {
    $arrClass = (is_array($class)) ? $class : explode(' ', $class);

    if (!array_key_exists('class', $this->_data) || is_null($this->_data['class']))
    {
      $this->_data['class'] = $arrClass;
    }
    else
    {
      $this->_data['class'] = array_merge($this->_data['class'], $arrClass);
    }

    $this->_data['class'] = array_keys(array_flip($this->_data['class']));

    return $this;
  }

  /**
   * Adds a CSS style property and value to the style attribute.  No validation is done of properties or attributes.
   *
   * @param string $style The CSS property to add
   * @param string $value the value to set the CSS property to
   *
   * @return $this
   */
  public function addStyle($style, $value)
  {
    $this->_data['style'][$style] = $value;

    return $this;
  }

  /**
   * Returns the attribute value for the given key.  This value is raw, and not normalized.
   *
   * @param string $key
   *
   * @return mixed|null
   */
  public function get($key)
  {
    return (array_key_exists($key, $this->_data)) ? $this->_data[$key] : null;
  }

  /**
   * Returns the CSS class attribute as an array or string.
   *
   * @param bool $asString
   *
   * @return array|string|null
   */
  public function getClass($asString = false)
  {
    if ($classes = $this->get('class'))
    {
      return ($asString) ? implode(' ', $classes) : $classes;
    }

    return null;
  }

  /**
   * Returns the style attribute as an associative array or a string.
   *
   * @param bool $asString
   *
   * @return array|string|null
   */
  public function getStyle($asString = false)
  {
    if ($styles = $this->get('style'))
    {
      if ($asString)
      {
        $cStyles = [];
        foreach ($styles as $key => $value)
        {
          if (!is_null($value))
          {
            $cStyles[] = sprintf('%s: %s;', $key, $value);
          }
        }

        return implode(' ', $cStyles);
      }

      return $styles;
    }

    return null;
  }

  /**
   * Indicated whether the given css class is present in the class attribute.
   *
   * @param string $class
   *
   * @return bool
   */
  public function hasClass($class)
  {
    return array_key_exists('class', $this->_data) && in_array($class, $this->_data['class']);
  }

  /**
   * Indicated whether the given css style property is present in the style attribute.
   *
   * @param string $style
   *
   * @return bool
   */
  public function hasStyle($style)
  {
    if (array_key_exists('style', $this->_data) && array_key_exists($style, $this->_data['style']))
    {
      return !is_null($this->_data['style'][$style]);
    }

    return false;
  }

  /**
   * Indicates whether the attribute value is set for the given key.
   *
   * @param string $key
   *
   * @return bool
   */
  public function has($key)
  {
    return array_key_exists($key, $this->_data) && !is_null($this->_data[$key]);
  }

  /**
   * Removes a single CSS class name from the class attribute.
   *
   * @param string $class
   *
   * @return $this
   */
  public function removeClass($class)
  {
    if ($key = array_search($class, $this->_data['class']))
    {
      unset($this->_data['class'][$key]);
    }

    return $this;
  }

  /**
   * Removes a CSS style rule from the style attribute using the rule's property as the key.
   *
   * @param string $style
   *
   * @return $this
   */
  public function removeStyle($style)
  {
    unset($this->_data['style'][$style]);

    return $this;
  }

  /**
   * Sets the given attribute to the given value, after validating that the value is scalar, boolean, or null.
   *
   * @param string                     $key
   * @param string|int|float|bool|null $value
   *
   * @return $this
   *
   * @throws \Exception
   */
  public function set($key, $value)
  {
    if ($method = $this->getMethodForKey($key))
    {
      return $this->$method($value);
    }
    elseif (in_array($key, self::URLS))
    {
      return $this->setAsUrl($key, $value);
    }
    elseif (!is_scalar($value) && !is_bool($value) && !is_null($value))
    {
      throw new \Exception(sprintf('Only scalar, boolean, and NULL values may be set as values for the HTML5 attribute "%s"', $key));
    }

    $this->_data[strtolower($key)] = $value;

    return $this;
  }

  /**
   * Sets the class attribute, overriding any previous value.
   *
   * @param array|string $class
   *
   * @return $this
   */
  public function setClass($class)
  {
    $arrClass = (is_array($class)) ? $class : explode(' ', $class);

    $this->_data['class'] = $arrClass;

    return $this;
  }

  /**
   * Sets the style attribute using the given string or array.
   *
   * Array should be in the format of CSS property => CSS value.
   *
   * Strings are parsed to determine the CSS rules within.  Each rule must have the trailing semicolon.
   *
   * @param string|array $style
   *
   * @return $this
   */
  public function setStyle($style)
  {
    if (!is_array($style))
    {
      $string = $style;
      $style  = [];
      if (preg_match_all('#([^:]+):\s?([^!;]+)([^;]+)?;#', $string, $m))
      {
        foreach ($m as $rule)
        {
          $property = (!empty($rule[2])) ? trim($rule[2]) : null;
          $value    = (!empty($rule[3])) ? trim($rule[3]) : null;
          $bang     = (!empty($rule[3])) ? trim($rule[3]) : null;

          $style[$property] = ($bang) ? $value.' '.$bang : $value;
        }
      }
    }

    $this->_data['style'] = $style;

    return $this;
  }

  /**
   * Compares the given value to this object to determine if they are equal.  Order of elements, CSS classes, or
   * CSS style rules does not matter for the purposes of this comparison.
   *
   * @param HtmlAttributes|array $compare
   */
  public function equals($compare): bool
  {
    // If we're given an array, attempt to convert it to an object for comparison.
    // If that isn't possible, return false
    if (!$compare instanceof HtmlAttributes && is_array($compare))
    {
      try
      {
        $compare = HtmlAttributes::fromArray($compare);
      }
      catch (\Exception $e)
      {
        return false;
      }
    }

    // If we now have an object, run a comparison
    if ($compare instanceof HtmlAttributes)
    {
      foreach ($this->_data as $key => $value)
      {
        if (!$compare->has($key))
        {
          return false;
        }
        elseif ('class' === $key)
        {
          // We just want to make sure we have the same values in the arrays
          $diff = array_diff($value, $compare->getClass());

          if (!empty($diff))
          {
            return false;
          }
        }
        elseif ('style' == $key)
        {
          // We want to make sure we have the same key & value pairs.
          $diff = array_diff_assoc($value, $compare->getStyle());

          if (!empty($diff))
          {
            return false;
          }
        }
      }

      return true;
    }

    return false;
  }

  public function __toString(): string
  {
    $final = [];
    $attr  = $this->toArray();
    $tmpl  = '%s="%s"';

    foreach ($attr as $key => $value)
    {
      if (is_array($value))
      {
        if ('style' == $key)
        {
          $final[] = sprintf($tmpl, $key, $this->getStyle(true));
        }
        elseif ('class' == $key)
        {
          $final[] = sprintf($tmpl, $key, $this->getClass(true));
        }
      }
      else
      {
        $final[] = sprintf($tmpl, $key, $value);
      }
    }

    return implode(' ', $final);
  }

  /**
   * Returns the attributes an array, with the values normalized to string and any null values
   * removed, so that they are suitable for output.
   *
   * @return array
   */
  public function toArray()
  {
    return $this->removeNullKeys($this->getNormalized($this->_data));
  }

  // region //////////////////////////////////////////////// Helper Methods

  /**
   * Normalizes the values of the given array for output as HTML5 attributes by converting numeric
   * and boolean values to strings.
   *
   * @param array $arr
   *
   * @return array
   */
  protected function getNormalized($arr)
  {
    foreach ($arr as $key => $value)
    {
      if (is_bool($value))
      {
        $arr[$key] = BooleanHelper::get()->toString($value);
      }
      elseif (is_int($value) || is_float($value))
      {
        $arr[$key] = (string) $value;
      }
    }

    return $arr;
  }

  /**
   * Removes values that are null from the given array so that they may be ommitted from output.
   *
   * @param array $arr
   *
   * @return array
   */
  protected function removeNullKeys($arr)
  {
    foreach ($arr as $key => $value)
    {
      if (is_null($value))
      {
        unset($arr[$key]);
      }
    }

    return $arr;
  }

  /**
   * If there is a specific method for the given key, returns the name of that method.
   *
   * @param string $key    The HTML5 attribute name
   * @param string $prefix the type of method to return: set, get, add, remove, has
   *
   * @return string|null the method, if it exists within this object
   */
  protected function getMethodForKey($key, $prefix = 'set')
  {
    if (array_key_exists($key, $this->special))
    {
      $method = strtolower($prefix).$this->special[$key];

      if (method_exists($this, $method))
      {
        return $method;
      }
    }

    return null;
  }

  /**
   * Set the given key to the given value, normalized as a URL.
   *
   * @param string     $key
   * @param Url|string $value
   *
   * @return $this
   */
  protected function setAsUrl($key, $value)
  {
    try
    {
      $this->_data[$key] = ($value instanceof Url) ? $value : new Url($value);
    }
    catch (\Exception $e)
    {
      $this->_data[$key] = $value;
    }

    return $this;
  }

  // endregion ///////////////////////////////////////////// End Helper Methods
}
