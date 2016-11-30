<?php
namespace WPStarterTheme\Modules\Layout;

use WPStarterTheme\Helpers\Module;

add_action('wp_enqueue_scripts', function () {
  Module::enqueueAssets('Layout', [
    [
      'name' => 'console-polyfill',
      'type' => 'script',
      'path' => 'vendor/console.js'
    ],
    [
      'name' => 'babel-polyfill',
      'type' => 'script',
      'path' => 'vendor/babel-polyfill.js'
    ],
    [
      'name' => 'document-register-element',
      'type' => 'script',
      'path' => 'vendor/document-register-element.js'
    ],
    [
      'name' => 'normalize',
      'path' => 'vendor/normalize.css', // uses automatically: Utils::requireAssetUrl(path)
      'type' => 'style' // or style
    ]
  ]);
});
