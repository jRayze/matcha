<body style="background-color:#444444;">
    <div style="text-align: center;color:white;" id="progressNb">
        0 / 500
    </div>
    <progress style="width:100%" id="progressbar" value="0" max="500"> 0% </progress>
    <div style="text-align: center;color:white; display:none;" id="homeLink">
        <a style="text-align: center;color:white;" href='/'>Acceuil</a>
    </div>
</body>
<?php
include "../utils/interests.php";
$sexual_orientation_list = array("heterosexual", "homosexual", "bisexual");

try {
    $conn = new PDO("mysql:host=localhost", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("DROP DATABASE IF EXISTS `matcha` ;");
} catch (PDOException $e) {
    echo "<br>" . $e->getMessage();
}
try {
    $conn = new PDO("mysql:host=localhost", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec(file_get_contents("matcha.sql"));
} catch(PDOException $e) {
    echo "<br>" . $e->getMessage();
}
try {
    $bdd = new PDO("mysql:host=localhost;dbname=matcha", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $overlay_images = array();
    for ($i = 1; $i <= 5; $i++) {
        array_push($overlay_images, imagecreatefrompng("../../img/".$i.".png"));
    }

    $response = file_get_contents("fakeusers.json");
    $response = json_decode($response);

    


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
        
        $imgs = array();

        for ($i = 1; $i <= 5; $i++) {
            $local_path = $value->{'picture'}->{'large'};
            $local_path = str_replace("https://randomuser.me/api/portraits", "../../img/user_images", $local_path);
            $im = imagecreatefromjpeg($local_path);

            imagecopy($im, $overlay_images[$i - 1], 5, 5, 0, 0, 32, 32);
            ob_start();
            imagepng($im);
            $contents = ob_get_contents();
            ob_end_clean();
            $final_img = "data:image/png;base64,".base64_encode($contents);
            //echo '<img src="'.$final_img.'">';
            array_push($imgs, $final_img);
        }

        $q = "INSERT INTO users (email, first_name, last_name, gender, verified, age, latitude, longitude, image1, image2, image3, image4, image5, popularity, sexual_orientation, bio, interests, profile_complete, password) VALUES ('$email', '$first_name', '$last_name', '$gender', 1, $age, $latitude, $longitude, '$imgs[0]', '$imgs[1]', '$imgs[2]', '$imgs[3]', '$imgs[4]', 0, '$sexual_orientation', '$bio', '$comma_separated', 1, '$2y$10\$D4X5TYUt8aPOyHqvFLGYKulqFx/mEObEH/RxTUYzmGCt3UWDb6.Hq');";
        //echo $q;
        $stmt = $bdd->prepare($q);
        $stmt->execute();
        echo "
        <script>
            document.getElementById('progressbar').value += 1;
            document.getElementById('progressNb').innerText = document.getElementById('progressbar').value + ' / ' + 500;
        </script>";
        }
        echo "
        <script>
            document.getElementById('progressNb').innerText = document.getElementById('progressbar').value + ' / ' + 500 + ' Setup done!';
            document.getElementById('homeLink').style.display = '';
        </script>";

} catch(PDOException $e) {
    echo "<br>" . $e->getMessage();
}
?>