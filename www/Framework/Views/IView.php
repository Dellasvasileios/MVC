<?php

namespace Framework\Views;

interface IView
{
   /**
    * Renders a view with the given data. The view file is expected to be located in the Views directory
    *
    * @param string $view_name The name of the view file (without .php extension).
    * it can include subdirectories, e.g., 'subdir/viewname'
    * @param array $data An associative array of data to be extracted for the view.
    * each key will become a variable in the view.
    * @return echo's a string The rendered view content.
    */
   public function get_view(string $view_name, array $data): string;
}