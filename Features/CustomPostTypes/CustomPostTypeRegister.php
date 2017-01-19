<?php

namespace Flynt\Features\CustomPostTypes;

use Flynt\Utils\FileLoader;

class CustomPostTypeRegister {

  private static $fileName;

  protected static function getConfigs($dir) {
    $configs = FileLoader::iterateDirectory($dir, function ($file) {
      if ($file->isDir()) {
        $configPath = $file->getPathname() . '/' . self::$fileName;

        if (is_file($configPath)) {
          return self::getConfigFromJson($configPath);
        }
      }
      return null;
    });

    return array_filter($configs);
  }

  protected static function getConfigFromJson($filePath) {
    return json_decode(file_get_contents($filePath), true);
  }

  public static function fromDirectory($dir, $fileName) {
    self::$fileName = $fileName;

    $postTypesConfig = self::getConfigs($dir);

    if(empty($postTypesConfig)) return;

    foreach ($postTypesConfig as $config) {
      self::fromArray($config);
    }
  }

  public static function fromArray($config) {
    if (isset($config['labels'])) {
      $config['labels'] = array_map(function ($label) {
        return __($label, 'Flynt');
      }, $config['labels']);
    }

    $name = $config['name'];
    unset($config['name']);

    register_post_type($name, $config);
  }
}
