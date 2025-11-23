<?php

namespace Framework\Views;

require_once BASE_PATH . "Framework/Views/IView.php";

class View implements IView
{
  public function get_view(string $view_name, array $data): string{
      $file = rtrim(BASE_PATH, DIRECTORY_SEPARATOR)
          . DIRECTORY_SEPARATOR . 'Views'
          . DIRECTORY_SEPARATOR . $view_name . '.php';

      if (!is_file($file) || !is_readable($file)) {
          throw new \RuntimeException("View not found: {$file}");
      }

      extract($data);
      ob_start();
      include $file;
      return (string) ob_get_clean();
  }
}