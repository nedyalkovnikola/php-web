<?php


namespace Service\Upload;


class UploadService implements UploadServiceInterface
{
    public function upload($fileInfo, $destination): string
    {
        $filePath = $destination . DIRECTORY_SEPARATOR . uniqid() . '_' . $fileInfo['name'];

        $result = move_uploaded_file($fileInfo['tmp_name'], $filePath);

        $filePath = dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR . $filePath;

        if ($result == false) {
            throw new \Exception("Upload failed");
        }

        return $filePath;
    }
}