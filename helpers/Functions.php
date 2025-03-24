<?php
namespace Helpers;

class Functions
{

    public function dd($content)
    {
        echo "<pre>";
        var_dump($content);
        echo "</pre>";
        exit();
    }
}