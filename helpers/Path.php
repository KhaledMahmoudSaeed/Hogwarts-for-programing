<?php
namespace Helpers;

class Path
{
    // method to reach the root directory
    public array $data = [];
    private const BATH_PATH = __DIR__ . "/../";
    public const IMAGE_PATH = "/resources/assets/img/";

    public function base_path($path)
    {
        return $this::BATH_PATH . $path;
    }
    public function view_path($path)
    {
        return $this::BATH_PATH . "public/resources/Views/" . $path;
    }
    public function view(string $viewPath, array $data = [])
    {
        if (!is_array($data)) {
            return var_dump("this is an string"); // Handle string case
        }
        require $this->view_path($viewPath);
    }
    public function image(string $imageName, string|null $directory = null): string
    {
        $imagePath = $this::IMAGE_PATH;
        if ($directory) {
            $imagePath .= $directory . "/";
        }

        return $imagePath . $imageName;
    }

}