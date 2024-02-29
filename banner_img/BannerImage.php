<?php

class BannerImage
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function getAvailableColors()
    {
        $colors = array();

        // Obtener colores de la tabla 'colors'
        $query = "SELECT * FROM colors";
        $result = mysqli_query($this->con, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $colors[] = $row;
        }

        return $colors;
    }

    public function insertBannerImage($sectionTitle, $bannerTitle, $description, $colorId, $img_name, $image_64_code, $image_extension)
    {
        // Insertar la imagen en la tabla 'images' utilizando consulta preparada
        $insertImageQuery = "INSERT INTO images (img_type_id, image_name, image_data, image_extension, active) VALUES (1, ?, ?, ?, true)";
        $stmtImage = mysqli_prepare($this->con, $insertImageQuery);

        // Verificar si la consulta preparada tuvo éxito
        if ($stmtImage) {
            mysqli_stmt_bind_param($stmtImage, "sss", $img_name, $image_64_code, $image_extension);
            $resultImage = mysqli_stmt_execute($stmtImage);

            // Verificar si la ejecución de la consulta tuvo éxito
            if ($resultImage) {
                // Obtener el ID de la última imagen insertada
                $imageId = mysqli_insert_id($this->con);

                // Insertar detalles del banner en la tabla 'banner' utilizando consulta preparada
                $insertBannerQuery = "INSERT INTO banner (section_title, banner_title, description, color_id, image_id) VALUES (?, ?, ?, ?, ?)";
                $stmtBanner = mysqli_prepare($this->con, $insertBannerQuery);

                // Verificar si la consulta preparada tuvo éxito
                if ($stmtBanner) {
                    mysqli_stmt_bind_param($stmtBanner, "sssii", $sectionTitle, $bannerTitle, $description, $colorId, $imageId);
                    $resultBanner = mysqli_stmt_execute($stmtBanner);

                    // Verificar si la ejecución de la consulta tuvo éxito
                    if ($resultBanner) {
                        // Éxito: mostrar mensaje de éxito
                        return true;
                    } else {
                        // Fallo al insertar detalles del banner
                        // Eliminar la imagen insertada previamente
                        $deleteImageQuery = "DELETE FROM images WHERE image_id = $imageId";
                        mysqli_query($this->con, $deleteImageQuery);

                        // Mostrar mensaje de error específico y detalles de la base de datos
                        echo "<script>alert('Error al insertar detalles del banner. Consulta: " . mysqli_error($this->con) . "')</script>";
                        return false;
                    }
                } else {
                    // Mostrar mensaje de error específico y detalles de la base de datos
                    echo "<script>alert('Error en la preparación de la consulta para insertar detalles del banner. Consulta: " . mysqli_error($this->con) . "')</script>";
                    return false;
                }
            } else {
                // Mostrar mensaje de error específico y detalles de la base de datos
                echo "<script>alert('Error al insertar la imagen. Consulta: " . mysqli_error($this->con) . "')</script>";
                return false;
            }
        } else {
            // Mostrar mensaje de error específico y detalles de la base de datos
            echo "<script>alert('Error en la preparación de la consulta para insertar la imagen. Consulta: " . mysqli_error($this->con) . "')</script>";
            return false;
        }
    }

    public function getBannerDetails($bannerId)
    {
        // Utilizar una consulta preparada para obtener detalles del banner
        $query = "SELECT * FROM banner WHERE banner_id = ?";
        $stmt = mysqli_prepare($this->con, $query);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            // Vincular el parámetro y ejecutar la consulta preparada
            mysqli_stmt_bind_param($stmt, 'i', $bannerId);
            mysqli_stmt_execute($stmt);

            // Obtener el resultado de la consulta
            $result = mysqli_stmt_get_result($stmt);

            // Verificar si la consulta devolvió resultados
            if ($result && $rowBanner = mysqli_fetch_assoc($result)) {
                // Cerrar la consulta preparada
                mysqli_stmt_close($stmt);

                // Construir el array de detalles del banner
                $banner = array(
                    'banner_id' => $rowBanner['banner_id'],
                    'section_title' => $rowBanner['section_title'],
                    'banner_title' => $rowBanner['banner_title'],
                    'description' => $rowBanner['description'],
                    'color_id' => $rowBanner['color_id'],
                    'image_id' => $rowBanner['image_id'],
                );

                // Agregar información de color
                $banner['color'] = $this->getColorInfo($banner['color_id']);

                // Agregar información de imagen
                $banner['image_data'] = $this->getImageData64($banner['image_id']);

                return $banner;
            }
        }

        return false; // Devolver false en caso de error o falta de resultados
    }







    public function getAllBanners()
    {
        $banners = array();

        $getBannersQuery = "SELECT * FROM banner";
        $runBanners = mysqli_query($this->con, $getBannersQuery);

        while ($rowBanners = mysqli_fetch_array($runBanners)) {
            $banner = array(
                'banner_id' => $rowBanners['banner_id'],
                'section_title' => $rowBanners['section_title'],
                'banner_title' => $rowBanners['banner_title'],
                'description' => $rowBanners['description'],
                'color_id' => $rowBanners['color_id'],
                'image_id' => $rowBanners['image_id'],
                'status' => $rowBanners['active'],
            );

            // Get color information from the colors table
            $banner['color'] = $this->getColorInfo($banner['color_id']);

            // Get image information from the images table
            $banner['image_data'] = $this->getImageData64($banner['image_id']);

            $banners[] = $banner;
        }

        return $banners;
    }

    private function getColorInfo($colorId)
    {
        // Utilizar una consulta preparada para obtener información del color
        $query = "SELECT * FROM colors WHERE color_id = ?";
        $stmt = mysqli_prepare($this->con, $query);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            // Vincular el parámetro y ejecutar la consulta preparada
            mysqli_stmt_bind_param($stmt, 'i', $colorId);
            mysqli_stmt_execute($stmt);

            // Obtener el resultado de la consulta
            $result = mysqli_stmt_get_result($stmt);

            // Verificar si la consulta devolvió resultados
            if ($result && $rowColor = mysqli_fetch_assoc($result)) {
                // Cerrar la consulta preparada
                mysqli_stmt_close($stmt);

                return array(
                    'color_name' => $rowColor['color_name'],
                    'color_rgb' => $rowColor['color_rgb'],
                );
            }
        }

        return array(); // Devolver un array vacío en caso de error o falta de resultados
    }

    private function getImageData64($imageId)
    {
        // Utilizar una consulta preparada para obtener información de la imagen
        $query = "SELECT * FROM images WHERE image_id = ?";
        $stmt = mysqli_prepare($this->con, $query);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            // Vincular el parámetro y ejecutar la consulta preparada
            mysqli_stmt_bind_param($stmt, 'i', $imageId);
            mysqli_stmt_execute($stmt);

            // Obtener el resultado de la consulta
            $result = mysqli_stmt_get_result($stmt);

            // Verificar si la consulta devolvió resultados
            if ($result && $rowImage = mysqli_fetch_assoc($result)) {
                // Cerrar la consulta preparada
                mysqli_stmt_close($stmt);

                return array(
                    'image_data' => $rowImage['image_data'],
                    'image_extension' => $rowImage['image_extension'],
                    'image_name' => $rowImage['image_name'],
                );
            }
        }

        return array(); // Devolver un array vacío en caso de error o falta de resultados
    }




    public function updateBannerImage($bannerId, $sectionTitle, $bannerTitle, $description, $colorId, $imageName, $imageData, $imageType) {
        // Actualizar la imagen en la tabla 'images'
        $updateImageQuery = "UPDATE images SET image_name = ?, image_data = ?, image_extension = ? WHERE image_id = 
        (SELECT image_id FROM banner WHERE banner_id = ?)";

        $stmtUpdateImage = mysqli_prepare($this->con, $updateImageQuery);

        if ($stmtUpdateImage) {
            mysqli_stmt_bind_param($stmtUpdateImage, "sssi", $imageName, $imageData, $imageType, $bannerId);
            $resultUpdateImage = mysqli_stmt_execute($stmtUpdateImage);

            if ($resultUpdateImage) {
                // Actualizar detalles del banner en la tabla 'banner'
                $updateBannerQuery = "UPDATE banner SET section_title = ?, banner_title = ?, description = ?, color_id = ? WHERE banner_id = ?";
                $stmtUpdateBanner = mysqli_prepare($this->con, $updateBannerQuery);

                if ($stmtUpdateBanner) {
                    mysqli_stmt_bind_param($stmtUpdateBanner, "sssii", $sectionTitle, $bannerTitle, $description, $colorId, $bannerId);
                    $resultUpdateBanner = mysqli_stmt_execute($stmtUpdateBanner);

                    if ($resultUpdateBanner) {
                        return true; // Éxito: actualización exitosa
                    } else {
                        echo "<script>alert('Error al actualizar detalles del banner. Consulta: " . mysqli_error($this->con) . "')</script>";
                        return false;
                    }
                } else {
                    echo "<script>alert('Error en la preparación de la consulta para actualizar detalles del banner. Consulta: " . mysqli_error($this->con) . "')</script>";
                    return false;
                }
            } else {
                echo "<script>alert('Error al actualizar la imagen. Consulta: " . mysqli_error($this->con) . "')</script>";
                return false;
            }
        } else {
            echo "<script>alert('Error en la preparación de la consulta para actualizar la imagen. Consulta: " . mysqli_error($this->con) . "')</script>";
            return false;
        }
    }


    public function updateBannerTextAndColor($bannerId, $sectionTitle, $bannerTitle, $description, $colorId) {
        // Actualizar detalles del banner en la tabla 'banner'
        $updateBannerQuery = "UPDATE banner SET section_title = ?, banner_title = ?, description = ?, color_id = ? WHERE banner_id = ?";

        $stmtUpdateBanner = mysqli_prepare($this->con, $updateBannerQuery);

        if ($stmtUpdateBanner) {
            mysqli_stmt_bind_param($stmtUpdateBanner, "sssii", $sectionTitle, $bannerTitle, $description, $colorId, $bannerId);
            $resultUpdateBanner = mysqli_stmt_execute($stmtUpdateBanner);

            if ($resultUpdateBanner) {
                return true; // Éxito: actualización exitosa
            } else {
                echo "<script>alert('Error al actualizar detalles del banner. Consulta: " . mysqli_error($this->con) . "')</script>";
                return false;
            }
        } else {
            echo "<script>alert('Error en la preparación de la consulta para actualizar detalles del banner. Consulta: " . mysqli_error($this->con) . "')</script>";
            return false;
        }
    }


    public function deleteBannerAndImage($bannerId) {
        // Obtener el ID de la imagen asociada al banner
        $getImageIdQuery = "SELECT image_id FROM banner WHERE banner_id = ?";
        $stmtGetImageId = mysqli_prepare($this->con, $getImageIdQuery);

        if ($stmtGetImageId) {
            mysqli_stmt_bind_param($stmtGetImageId, "i", $bannerId);
            mysqli_stmt_execute($stmtGetImageId);

            $resultGetImageId = mysqli_stmt_get_result($stmtGetImageId);
            $rowImageId = mysqli_fetch_assoc($resultGetImageId);
            $imageId = $rowImageId['image_id'];

            // Eliminar el banner de la tabla 'banner'
            $deleteBannerQuery = "DELETE FROM banner WHERE banner_id = ?";
            $stmtDeleteBanner = mysqli_prepare($this->con, $deleteBannerQuery);

            if ($stmtDeleteBanner) {
                mysqli_stmt_bind_param($stmtDeleteBanner, "i", $bannerId);
                $resultDeleteBanner = mysqli_stmt_execute($stmtDeleteBanner);

                if ($resultDeleteBanner) {
                    // Eliminar la imagen de la tabla 'images'
                    $deleteImageQuery = "DELETE FROM images WHERE image_id = ?";
                    $stmtDeleteImage = mysqli_prepare($this->con, $deleteImageQuery);

                    if ($stmtDeleteImage) {
                        mysqli_stmt_bind_param($stmtDeleteImage, "i", $imageId);
                        $resultDeleteImage = mysqli_stmt_execute($stmtDeleteImage);

                        if ($resultDeleteImage) {
                            return true; // Éxito: eliminación exitosa
                        } else {
                            echo "<script>alert('Error al eliminar la imagen asociada al banner. Consulta: " . mysqli_error($this->con) . "')</script>";
                            return false;
                        }
                    } else {
                        echo "<script>alert('Error en la preparación de la consulta para eliminar la imagen asociada al banner. Consulta: " . mysqli_error($this->con) . "')</script>";
                        return false;
                    }
                } else {
                    echo "<script>alert('Error al eliminar el banner. Consulta: " . mysqli_error($this->con) . "')</script>";
                    return false;
                }
            } else {
                echo "<script>alert('Error en la preparación de la consulta para eliminar el banner. Consulta: " . mysqli_error($this->con) . "')</script>";
                return false;
            }
        } else {
            echo "<script>alert('Error en la preparación de la consulta para obtener el ID de la imagen asociada al banner. Consulta: " . mysqli_error($this->con) . "')</script>";
            return false;
        }
    }



}

?>