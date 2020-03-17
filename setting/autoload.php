<?php

spl_autoload_register(function($class) {
  $fileFirst = 'MyApp\\';
  if(strpos($class, $fileFirst) === 0) {
    $fileLast = substr($class, strlen($fileFirst));
    $path = __DIR__ . '/../next' . str_replace('\\', '/', $fileLast) . '.php';
    if(file_exists($path)) {
      require $path;
    }
  }
});