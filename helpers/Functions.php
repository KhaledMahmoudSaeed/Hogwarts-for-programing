<?php
namespace Helpers;
use Helpers\Path;
use Respect\Validation\Validator as v;


class Functions
{
    private v $v;
    private array $VALIDATION_RULES;
    private array $ERROR_MESSAGES;
    public function __construct()
    {
        $this->v = v::create();
        $this->VALIDATION_RULES = [
            "email" => $this->v::email(),
            "name" => $this->v::alpha(" ", "-")->notEmpty()->length(1, 200),
            "password" => $this->v::length(8)
                ->regex('/[A-Z]/')
                ->regex('/[a-z]/')
                ->regex('/\d/')
                ->regex('/[!@#$%^&*()\-_=+{};:,<.>?\[\]\/|~`"\']+/'),
            "number" => $this->v::intVal()->positive(),
            "string" => $this->v::stringType()
                ->notEmpty()
                ->length(1, 200)
                ->alnum('-_', '.', ' ')
        ];
        $this->ERROR_MESSAGES = [
            "email" => "Please enter a valid email address.",
            "name" => "Name must be 1–200 characters and contain only letters, spaces, or hyphens.",
            "password" => "Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.",
            "img" => "Image must be a valid JPG, PNG file under 2MB.",
            "number" => "Number must be a positive integer.",
            "string" => "This field must be a string between 1–200 characters and contain only alphanumeric, underscore, dash, or dot.",
        ];
    }
    public function dd($content)
    {
        echo "<pre>";
        var_dump($content);
        echo "</pre>";
        exit();
    }
    public function insertImage(string $ImageDirectory)
    {
        if (!isset($_FILES['img']) || $_FILES['img']['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        $allowedExtentions = ['image/jpeg', 'image/png', 'image/jpg'];
        $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($fileinfo, $_FILES['img']['tmp_name']);
        finfo_close($fileinfo);
        if (!in_array($mimetype, $allowedExtentions)) {
            throw new \InvalidArgumentException("Invalid file type. Only images are allowed.");
        }
        $extension = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));
        $img = time() . "_$ImageDirectory." . $extension;
        $targetFile = (new Path)->base_path("public" . $GLOBALS['img']::IMAGE_PATH . "$ImageDirectory/" . $img);
        try {
            if (!move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
                throw new \RuntimeException("Failed to move uploaded file.");
            }
            return $img;
        } catch (\Throwable $th) {
            // Log error instead of dying
            error_log("Image upload error: " . $th->getMessage());
            return 'w';
        }
    }
    public function deleteImage(string $imageDirectory, string $imageName): bool
    {
        $imagePath = (new Path)->base_path("public" . $GLOBALS['img']::IMAGE_PATH . "$imageDirectory/" . $imageName);
        if (!file_exists($imagePath)) {
            return false;
        }
        if (!is_writable($imagePath)) {
            throw new \RuntimeException("File is not writable");
        }
        try {
            return unlink($imagePath);
        } catch (\Throwable $th) {
            error_log("Image deletion error: " . $th->getMessage());
            return false;
        }
    }
    public function validators(array $inputs)
    {
        foreach ($inputs as $key => $value) {
            if (!$this->VALIDATION_RULES[$key]->validate($value)) {
                $_SESSION['errors'][$key] = $this->ERROR_MESSAGES[$key];
                $errorExists = true;
            }
        }
        if ($errorExists) {
            return false;
        }
        return true;
    }
    public function pagination(array $data): array
    {
        // PAGINATION SETTINGS
        $perPage = 10;
        $currentPage = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
        $totalItems = count($data);
        $totalPages = (int) ceil($totalItems / $perPage);
        $offset = ($currentPage - 1) * $perPage;

        // SLICE DATA FOR CURRENT PAGE
        return [
            "totalPages" => $totalPages,
            "currentPage" => $currentPage,
            "offset" => $offset,
            "pageData" => array_slice($data, $offset, $perPage),
        ];
    }

}