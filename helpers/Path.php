<?php
namespace Helpers;

class Path
{
    // method to reach the root directory
    private const BATH_PATH = __DIR__ . "/../";
    public function base_path($path)
    {
        return $this::BATH_PATH . $path;
    }
    public function view_path($path)
    {
        return $this::BATH_PATH . "public/resources/Views/" . $path;
    }
}