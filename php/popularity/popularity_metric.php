<?php
function calculate_popularity() {
    $bdd = get_connection();
    $stmt = $bdd->prepare("UPDATE users SET popularity=0;
    SELECT COUNT(*) AS c into @myVar FROM notif_likes GROUP BY to_user ORDER BY c DESC LIMIT 1;
    UPDATE users u INNER JOIN (SELECT to_user, COUNT(*) AS c2 FROM notif_likes GROUP BY to_user) AS c3 ON u.id=c3.to_user SET u.popularity=CEILING(((c3.c2 / @myVar) * 100) / 20);");
    $stmt->execute();
}
?>