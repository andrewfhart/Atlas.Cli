<?php
/**
 *
 * This file is part of Atlas for PHP.
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 */
namespace Atlas\Cli;

use Atlas\Cli\Exception;

/**
 *
 * File system input/output.
 *
 * @package atlas/cli
 *
 */
class Fsio
{
    public function get($file)
    {
        $level = error_reporting(0);
        $result = file_get_contents($file);
        error_reporting($level);

        if ($result !== false) {
            return $result;
        }

        $error = error_get_last();
        throw new Exception($error['message']);
    }

    public function put($file, $data)
    {
        $level = error_reporting(0);
        $result = file_put_contents($file, $data);
        error_reporting($level);

        if ($result !== false) {
            return $result;
        }

        $error = error_get_last();
        throw new Exception($error['message']);
    }

    public function isFile($file)
    {
        return file_exists($file) && is_readable($file);
    }

    public function isDir($dir)
    {
        return is_dir($dir);
    }

    public function mkdir($dir, $mode = 0777, $deep = true)
    {
        $level = error_reporting(0);
        $result = mkdir($dir, $mode, $deep);
        error_reporting($level);

        if ($result !== false) {
            return;
        }

        $error = error_get_last();
        throw new Exception($error['message']);
    }

    public function getCwd()
    {
        return getcwd();
    }
}
