<?php
namespace Helpers;

class Path
{
    // method to reach the root directory
    public array $data = [];
    private const BATH_PATH = __DIR__ . "/../";
    public const IMAGE_PATH = "/resources/assets/img/";
    // return the view root path
    public function base_path($path)
    {
        return $this::BATH_PATH . $path;
    }
    // return the view directory path
    public function view_path($path)
    {
        return $this::BATH_PATH . "public/resources/Views/" . $path;
    }
    // return the view directory path and ability to pass data

    public function view(string $viewPath, array $data = [])
    {
        if (!is_array($data)) {
            return var_dump("this is an string"); // Handle string case
        }
        require $this->view_path($viewPath);
    }
    // return the img directory path

    public function image(string $imageName, string|null $directory = null): string
    {
        $imagePath = $this::IMAGE_PATH;
        if ($directory) {
            $imagePath .= $directory . "/";
        }

        return $imagePath . $imageName;
    }

}