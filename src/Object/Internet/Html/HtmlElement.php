<?php
/**
 * HtmlElement.php.
 */

namespace DevCoding\Object\Internet\Html;

use DevCoding\Object\Type\StringLiteral;

/**
 * Object representing an HTML element, with methods for easily manipulating attributes via an HtmlAttribute object,
 * adding children, and output as an HTML tag.
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 * @package DevCoding\Object\Internet\Html
 */
class HtmlElement
{
  const SELF_CLOSING = ['area', 'base', 'col', 'command', 'embed', 'keygen', 'source', 'track', 'wbr', 'img', 'br', 'hr', 'input', 'link', 'meta', 'param'];

  /** @var HtmlAttributes */
  protected $attributes;
  /** @var string */
  protected $tag;
  /** @var HtmlElement[]|string[] */
  protected $children;

  /**
   * @param HtmlAttributes|array|null $attr
   */
  public function __construct(string $tag, $attr = null)
  {
    $this->tag = $tag;

    if (isset($attr))
    {
      $this->setAttributes($attr);
    }
  }

  // region //////////////////////////////////////////////// Public Methods

  /**
   * @return string
   */
  public function __toString()
  {
    try
    {
      return $this->output();
    }
    catch (\Exception $e)
    {
      return '';
    }
  }

  /**
   * Adds a child to the HtmlElement, typically another HtmlElement or a string.
   *
   * @param HtmlElement|StringLiteral|string $child
   *
   * @return $this
   */
  public function addChild($child)
  {
    if (is_scalar($child))
    {
      $this->children[] = $child;
    }
    elseif (is_object($child) && method_exists($child, '__toString'))
    {
      $this->children[] = $child;
    }
    else
    {
      throw new \InvalidArgumentException(sprintf('Children of a "%s" must be scalar or implement a "__toString" method.', get_class($this)));
    }

    return $this;
  }

  /**
   * Returns the HtmlAttributes object, which can then be manipulated to add/remove different attributes.
   */
  public function getAttributes(): HtmlAttributes
  {
    if (empty($this->attributes))
    {
      $this->attributes = new HtmlAttributes([]);
    }

    return $this->attributes;
  }

  /**
   * Returns an array of the child elements of this HtmlElement.
   *
   * @return HtmlElement[]|string[]
   */
  public function getChildren()
  {
    return $this->isSelfClosing() ? [] : $this->children ?? [];
  }

  /**
   * Returns the children of this HtmlElement as an HTML string.
   *
   * @return string
   */
  public function getContents()
  {
    $inner = '';
    foreach ($this->getChildren() as $child)
    {
      if (is_object($child))
      {
        // Everything should be an object with the __toString method, guaranteed by the setter.
        $child = (string) $child;
      }

      $inner .= $child;
    }

    return $inner;
  }

  /**
   * Returns the HTML tag used for this HtmlElement.
   */
  public function getTag(): string
  {
    return $this->tag;
  }

  /**
   * Evaluates whether this HtmlElement uses a self-closing tag.
   *
   * @return bool
   */
  public function isSelfClosing()
  {
    return in_array($this->getTag(), self::SELF_CLOSING);
  }

  /**
   * Outputs the HtmlElement object as HTML with all children and attributes. Unlike the __toString method, this
   * method allows for child elements to throw Exceptions.
   *
   * @return string
   */
  public function output()
  {
    if ($this->isSelfClosing())
    {
      $tmpl = '<%s %s />';

      return sprintf($tmpl, $this->getTag(), $this->getAttributes()->__toString());
    }
    else
    {
      return sprintf(
          '<%s %s>%s</%s>',
          $this->getTag(),
          $this->getAttributes(),
          $this->getContents(),
          $this->getTag()
      );
    }
  }

  /**
   * @param HtmlAttributes|array $attributes
   *
   * @return $this
   */
  public function setAttributes($attributes)
  {
    if (!$attributes instanceof HtmlAttributes)
    {
      if (is_array($attributes))
      {
        $attributes = new HtmlAttributes($attributes);
      }
      else
      {
        throw new \InvalidArgumentException('The given attributes must be an array or an HtmlAttributes object.');
      }
    }

    $this->attributes = $attributes;

    return $this;
  }

  /**
   * Sets the children of this HtmlElement, removing any previous children.
   *
   * @param HtmlElement[]|string[] $children the children to set
   */
  public function setChildren(array $children): HtmlElement
  {
    $this->children = [];

    foreach ($children as $child)
    {
      $this->addChild($child);
    }

    return $this;
  }

  // endregion ///////////////////////////////////////////// Public Methods
}
