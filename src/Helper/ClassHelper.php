<?php

namespace DevCoding\Helper;

/**
 * @method  ClassHelper get();
 *
 * @author  AMJones <am@jonesiscoding.com>
 * @license https://github.com/deviscoding/objection/blob/main/LICENSE
 * @package DevCoding\Helper
 */
class ClassHelper
{
  use SingletonTrait;

  /** @var string */
  protected $projectDir;
  /** @var array */
  protected $classes;

  /**
   * Returns an array of classes in the given namespace.
   *
   * @param string $namespace
   *
   * @return string[]
   */
  public function getClassesInNamespace($namespace)
  {
    if (!isset($this->classes[$namespace]))
    {
      $this->classes[$namespace] = [];
      if ($dir = $this->getNamespaceDirectory($namespace))
      {
        foreach (glob($dir.'/*.php') as $file)
        {
          $fqcn = $namespace.'\\'.str_replace('.php', '', $file);

          if (class_exists($fqcn))
          {
            $this->classes[$namespace] = $fqcn;
          }
        }
      }
    }

    return $this->classes[$namespace];
  }

  /**
   * Returns the appropriate filesystem path for the given namespace.
   *
   * @param string $namespace
   *
   * @return string|null
   */
  protected function getNamespaceDirectory($namespace)
  {
    $defined = $this->getDefinedNamespaces();

    foreach ($defined as $ns => $dir)
    {
      if ($ns == $namespace)
      {
        return $this->getProjectDir().$dir;
      }
    }

    return null;
  }

  /**
   * Returns a list of the defined namespaces in the composer autoloader.
   *
   * @return string[]
   */
  protected function getDefinedNamespaces()
  {
    $composerJsonPath = $this->getProjectDir().'/composer.json';
    $composerConfig   = json_decode(file_get_contents($composerJsonPath));

    return (array) $composerConfig->autoload->{'psr-4'};
  }

  /**
   * Borrowed from a similar method in the Symfony kernel.
   *
   * @return string
   */
  protected function getProjectDir()
  {
    if (null === $this->projectDir)
    {
      $r = new \ReflectionObject($this);

      if (!file_exists($dir = $r->getFileName()))
      {
        throw new \LogicException(sprintf('Cannot auto-detect project dir for kernel of class "%s".', $r->name));
      }

      $dir = $rootDir = \dirname($dir);
      while (!file_exists($dir.'/composer.json'))
      {
        if ($dir === \dirname($dir))
        {
          return $this->projectDir = $rootDir;
        }
        $dir = \dirname($dir);
      }
      $this->projectDir = $dir;
    }

    return $this->projectDir;
  }
}
