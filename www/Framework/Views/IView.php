<?php

namespace Framework\Views;

interface IView
{
   public function get_view(string $view_name, array $data): string;
}