<?php

namespace Framework\Views;

class View implements IView
{
  public function get_view(string $view_name, array $data): string{

      $file = rtrim(BASE_PATH, '/') . '/Views/' . $view_name . '.php';

      if (!is_file($file) || !is_readable($file)) {
          throw new \RuntimeException("View not found: {$file}");
      }

      extract($data);
      ob_start();
      include $file;
      return (string) ob_get_clean();
  }
}