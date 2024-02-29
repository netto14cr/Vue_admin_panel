<?php

class ImageUploader
{
    private $uploadDir = 'img/banner/'; // Directorio donde se guardarán las imágenes

    public function uploadImage($file, $maxFileSizeMB = 5)
    {
        $fileName = $file['name'];
        $tempFilePath = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Obtener la extensión del archivo
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Generar un nombre único para evitar conflictos
        $uniqueFileName = uniqid('image_') . '.' . $fileExtension;

        // Ruta completa para guardar la imagen
        $targetPath = $this->uploadDir . $uniqueFileName;

        // Crear el directorio de subida si no existe
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }

        // Verificar si el archivo es una imagen
        if (getimagesize($tempFilePath) === false) {
            return false; // No es una imagen válida
        }

        // Verificar el tamaño del archivo
        $maxFileSizeBytes = $maxFileSizeMB * 1024 * 1024; // Convertir a bytes
        if ($fileSize > $maxFileSizeBytes) {
            return false; // Tamaño de archivo demasiado grande
        }

        // Mover el archivo al directorio de subida
        if (move_uploaded_file($tempFilePath, $targetPath)) {
            $imageData = file_get_contents($targetPath);

            // Devolver información de la imagen
            return [
                'name' => $uniqueFileName,
                'data' => base64_encode($imageData),
                'type' => $fileExtension,
            ];
        } else {
            return false; // Error al mover el archivo
        }
    }


    // Función para convertir la imagen a base64 sin perder calidad
    function convertToBase64($source, $mime, $originalName) {
        // Crear la imagen desde el archivo fuente según el tipo MIME
        $image = null;
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($source);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($source);
                break;

            // Puedes agregar más casos según los formatos de imagen que desees manejar
        }

        // Obtener el contenido de la imagen en base64
        ob_start();
        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($image, null);
                break;
            case 'image/png':
                imagepng($image, null);
                break;
            case 'image/gif':
                imagegif($image);
                break;
            case 'image/webp':
                imagewebp($image);
                break;

        }
        $imageData = ob_get_contents();
        ob_end_clean();

        imagedestroy($image);

        // Mantener el nombre y tipo de la imagen original
        return [
            'name' => $originalName,
            'data' => base64_encode($imageData), // Codificar en base64 para almacenar en la base de datos
            'type' => $mime,
        ];
    }




    // Función para comprimir la imagen utilizando GD
    function compressImage($source, $mime, $originalName, $quality) {
        // Obtener las dimensiones originales de la imagen
        list($width, $height) = getimagesize($source);

        // Crear la imagen desde el archivo fuente según el tipo MIME
        $image = null;
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            // Puedes agregar más casos según los formatos de imagen que desees manejar
        }

        // Comprimir la imagen con calidad ajustable
        ob_start();
        switch ($mime) {
            case 'image/jpeg':
                // Para formatos JPEG, ajusta la calidad con la función imagejpeg
                imagejpeg($image, null, $quality);
                break;
            case 'image/png':
                // Para formatos PNG, ajusta la compresión con la función imagepng
                imagepng($image, null, 9 - round($quality * 0.1));
                break;
        }
        $compressedImageData = ob_get_contents();
        ob_end_clean();

        imagedestroy($image);

        // Mantener el nombre y tipo de la imagen original
        return [
            'name' => $originalName,
            'data' => base64_encode($compressedImageData), // Codificar en base64 para almacenar en la base de datos
            'type' => $mime,
        ];
    }






}


?>