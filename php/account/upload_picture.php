<?php
session_start();
include "../database/sql.php";
include "./check_missing_infos.php";

if (isset($_SESSION["user_id"])) {
    if (isset($_POST["imageSelect"]) && isset($_FILES["image"])) {
        if ($_FILES["image"]["size"] < 1000000) {
            $img_id = intval($_POST["imageSelect"]);
            if ($img_id > 0 && $img_id < 6) {
                $target_file = basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if ($imageFileType === "png" || $imageFileType === "jpg") {
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    $data = file_get_contents($_FILES["image"]["tmp_name"]);
                    $final_img = "data:image/png;base64," . base64_encode($data);
                    $img_field = "image".$img_id;
                    $bdd = get_connection();
                    $stmt = $bdd->prepare("UPDATE users SET $img_field='$final_img' WHERE id=$_SESSION[user_id];");
                    $stmt->execute();

                    $stmt_profile_changed = $bdd->prepare("SELECT * from users WHERE id=$_SESSION[user_id];");
                    $stmt_profile_changed->execute();
                    if (($query = $stmt_profile_changed->fetch())) {
                        $_SESSION["db_infos"] = $query;
                        if (profile_is_complete($query)) {
                            $stmt = $bdd->prepare("UPDATE users SET profile_complete=1 WHERE id=$query[id];");
                            $stmt->execute();
                        } else {
                            $stmt = $bdd->prepare("UPDATE users SET profile_complete=0 WHERE id=$query[id];");
                            $stmt->execute();
                        }
                    }
                } else {
                    $_SESSION["update_profile_error"] = "Invalid file extension";
                }
            }
        } else {
            $_SESSION["update_profile_error"] = "File too big";
        }
    }
}

function resizeImage($filename, $max_width, $max_height)
{
    list($orig_width, $orig_height) = getimagesize($filename);

    $width = $orig_width;
    $height = $orig_height;

    # taller
    if ($height > $max_height) {
        $width = ($max_height / $height) * $width;
        $height = $max_height;
    }

    # wider
    if ($width > $max_width) {
        $height = ($max_width / $width) * $height;
        $width = $max_width;
    }

    $image_p = imagecreatetruecolor($width, $height);

    $image = imagecreatefromjpeg($filename);

    imagecopyresampled($image_p, $image, 0, 0, 0, 0,
                                     $width, $height, $orig_width, $orig_height);

    return $image_p;
}

header('Location: /profile');
?>