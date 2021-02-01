<?php
include "../database/sql.php";
include "../utils/interests.php";

session_start();

$sexual_orientation_list = array("heterosexual", "homosexual", "bisexual");

if (isset($_GET["count"]) && intval($_GET["count"]) > 0 && intval($_GET["count"]) < 500) {
    if (isset($_SESSION["user_id"])) {
        $bdd = get_connection();
        $stmt = $bdd->prepare("SELECT * FROM users WHERE id='$_SESSION[user_id]' AND admin=1;");
        $stmt->execute();
        if (($query = $stmt->fetch())) {
            $count = intval($_GET["count"]);
            $response = file_get_contents("https://randomuser.me/api/?nat=fr&results=$count&inc=gender,name,location,picture,email,registered");
            $response = json_decode($response);

            $overlay_images = array();

            for ($i = 1; $i <= 5; $i++) {
                array_push($overlay_images, imagecreatefrompng("../../img/".$i.".png"));
            }

            foreach ($response->{'results'} as &$value) {
                $first_name = $value->{'name'}->{'first'};
                $last_name = $value->{'name'}->{'last'};
                $gender = $value->{'gender'};
                $age = rand(18,100);
                $latitude = rand(48970, 48740) / 1000;
                $longitude = rand(2150, 2550) / 1000;
                $popularity = rand(0, 5);
                $sexual_orientation = $sexual_orientation_list[rand(0, 2)];
                $bio = "This is my bio";

                $nb_interests = rand(0, count($interest_list) - 1);
                shuffle($interest_list);
                $interest_array = array();
                for ($x = 0; $x < $nb_interests; $x++) {
                    array_push($interest_array, $interest_list[$x]);
                }
                $comma_separated = implode(",", $interest_array);
                
                $email = $value->{'email'};
    
                $type = pathinfo($value->{'picture'}->{'large'}, PATHINFO_EXTENSION);
                $base64 = 'data:image/'.$type.';base64,'.base64_encode(file_get_contents($value->{'picture'}->{'large'}));
                
                $imgs = array();

                for ($i = 1; $i <= 5; $i++) {
                    $im = imagecreatefromjpeg($value->{'picture'}->{'large'});
                    imagecopy($im, $overlay_images[$i - 1], 5, 5, 0, 0, 32, 32);
                    ob_start();
                    imagepng($im);
                    $contents = ob_get_contents();
                    ob_end_clean();
                    $final_img = "data:image/png;base64,".base64_encode($contents);
                    echo '<img src="'.$final_img.'">';
                    array_push($imgs, $final_img);
                }
    
                $q = "INSERT INTO users (email, first_name, last_name, gender, verified, age, latitude, longitude, image1, image2, image3, image4, image5, popularity, sexual_orientation, bio, interests, profile_complete, password) VALUES ('$email', '$first_name', '$last_name', '$gender', 1, $age, $latitude, $longitude, '$imgs[0]', '$imgs[1]', '$imgs[2]', '$imgs[3]', '$imgs[4]', 0, '$sexual_orientation', '$bio', '$comma_separated', 1, '$2y$10\$D4X5TYUt8aPOyHqvFLGYKulqFx/mEObEH/RxTUYzmGCt3UWDb6.Hq');";
                echo $q;
                $stmt = $bdd->prepare($q);
                $stmt->execute();
            }
        }
    }
} else {
    echo "<a href='http://localhost/php/utils/random_users.php?count=10'>Wrong url, click here to generate 10 users</a>";
}

?>