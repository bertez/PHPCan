<?php
/**
* phpCan - http://idc.anavallasuiza.com/
*
* phpCan is released under the GNU Affero GPL version 3
*
* More information at license.txt
*/

namespace ANS\PHPCan;

defined('ANS') or die();

class Loader {
    static private $loaded = false;
    static private $classes = array();
    static private $namespaces = array();
    static private $composer = array();

    /**
     * static public function register (string $path)
     *
     * Installs this class loader on the SPL autoload stack.
     */
    static public function register ($path)
    {
        if (self::$loaded === false) {
            self::$loaded = spl_autoload_register(__NAMESPACE__.'\\Loader::autoload');
        }

        if (!is_file($path.'clases-namespaces.php')) {
            return false;
        }

        $default = include ($path.'clases-namespaces.php');

        self::registerClass($default['classes']);
        self::registerNamespace($default['namespaces']);
    }

    /**
     * static public function unregister ()
     *
     * Uninstalls this class loader from the SPL autoloader stack.
     */
    static public function unregister ()
    {
        spl_autoload_unregister(__NAMESPACE__.'\\Loader::autoload');
    }

    /**
     * static public function autoload ($class)
     *
     * Basic autoload function
     * Returns boolean
     */
    static public function autoload ($class)
    {
        $class = ltrim($class, '\\');

        if (isset(self::$classes[$class]) && is_file(self::$classes[$class])) {
            return require (self::$classes[$class]);
        }

        $file  = '';
        $namespace = '';

        if ($lastNsPos = strripos($class, '\\')) {
            $namespace = substr($class, 0, $lastNsPos);
            $class = substr($class, $lastNsPos + 1);
            $file  = preg_replace('#[\\\/]+#', '/', $namespace.'/');
        }

        $file .= $class.'.php';

        if (is_file(LIBS_PATH.$file)) {
            return require (LIBS_PATH.$file);
        } else if (MODULE_NAME && is_file(MODULE_PATH.'libs/'.$file)) {
            return require (MODULE_PATH.'libs/'.$file);
        } else if (is_file(SCENE_PATH.'libs/'.$file)) {
            return require (SCENE_PATH.'libs/'.$file);
        } else {
            foreach (self::$namespaces as $ns => $path) {
                if (strpos($namespace, $ns) !== 0) {
                    continue;
                }

                $namespace_file = preg_replace('#[\\\/]+#', '/', ($path.'/'.$file));

                if (is_file($namespace_file)) {
                    return require ($namespace_file);
                }
            }
        }

        return false;
    }

    /**
     * static public function registerClass (array $classes)
     * static public function registerClass (string $class, string $path)
     *
     * Sets a new path for an specific class
     * Returns none
     */
    static public function registerClass ($class, $path = null)
    {
        if (is_array($class)) {
            foreach ($class as $class => $path) {
                self::$classes[$class] = $path;
            }

            return;
        }

        self::$classes[$class] = $path;
    }

    /**
     * static public function registerNamespace (array $namespaces)
     * static public function registerNamespace (string $namespace, string $path)
     *
     * Sets a new base path for an specific namespace
     * Returns none
     */
    static public function registerNamespace ($namespace, $path = null)
    {
        if (is_array($namespace)) {
            foreach ($namespace as $namespace => $path) {
                self::$namespaces[$namespace] = $path;
            }

            return;
        }

        self::$namespaces[$namespace] = $path;
    }

    /**
     * static public function registerComposer ([string $path])
     *
     * Register the classes installed by composer
     * Returns none
     */
    static function registerComposer ($path = '')
    {
        $path = $path ?: LIBS_PATH;

        if (isset(self::$composer[$path])) {
            return true;
        }

        if (is_file($path.'autoload.php')) {
            self::$composer[$path] = include_once ($path.'autoload.php');
        }
    }
}
