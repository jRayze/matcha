<?php
include "../database/sql.php";
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
                //$latitude = $value->{'location'}->{'coordinates'}->{'latitude'};
                //$longitude = $value->{'location'}->{'coordinates'}->{'longitude'};
                $email = $value->{'email'};
    
                $type = pathinfo($value->{'picture'}->{'large'}, PATHINFO_EXTENSION);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($value->{'picture'}->{'large'}));
    
                $q = "INSERT INTO users (email, first_name, last_name, gender, verified, age, latitude, longitude, image1, profile_image, popularity, sexual_orientation, bio) VALUES ('$email', '$first_name', '$last_name', '$gender', 1, $age, $latitude, $longitude, '$base64', 1, $popularity, '$sexual_orientation', '$bio');";
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