<?php
namespace Helpers;
use Helpers\Path;

class Functions
{

    public function dd($content)
    {
        echo "<pre>";
        var_dump($content);
        echo "</pre>";
        exit();
    }
    public function insertImage(string $ImageDirectory)
    {

        if (!isset($_FILES['img']) && $_FILES['img']['error'] !== UPLOAD_ERR_OK) {
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
}