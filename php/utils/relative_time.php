<?php
function get_relative_time($date) {
    $current_date = new DateTime(date('m/d/Y h:i:s a', time()));
    $target_date = new DateTime($date, new DateTimeZone('Europe/Paris'));
    $diff = date_diff($current_date, $target_date);

    if ($diff->y > 0) {
        if ($diff->y > 1) {
            return ($diff->y." years ago");
        } else {
            return ($diff->y." year ago");
        }
    }
    if ($diff->m > 0) {
        if ($diff->m > 1) {
            return ($diff->m." months ago");
        } else {
            return ($diff->m." month ago");
        }
    }
    if ($diff->d > 0) {
        if ($diff->d > 1) {
            return ($diff->d." days ago");
        } else {
            return ($diff->d." day ago");
        }
    }
    if ($diff->h > 0) {
        if ($diff->h > 1) {
            return ($diff->h." hours ago");
        } else {
            return ($diff->h." hour ago");
        }
    }
    if ($diff->i > 0) {
        if ($diff->i > 1) {
            return ($diff->i." minutes ago");
        } else {
            return ($diff->i." minute ago");
        }
    }
    if ($diff->s > 0) {
        if ($diff->s > 1) {
            return ($diff->s." seconds ago");
        } else {
            return ($diff->s." second ago");
        }
    }
    return ("0 second ago");
}
?>