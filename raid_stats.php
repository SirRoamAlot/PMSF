<?php
require_once(dirname(dirname(__FILE__)) . "/wp-load.php");

if (!is_user_logged_in()) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    wp_redirect(wp_login_url($actual_link));
    die();
}
$current_user = wp_get_current_user();
include('config/config.php');
global $map, $fork, $db;

$data = $db->query('SELECT username,COUNT(*) as count FROM raids_info GROUP BY username ORDER BY COUNT(*) DESC LIMIT 20')->fetchAll();

// also update fort_sightings so PMSF knows the gym has changed
// todo: put team stuff in here too


$jaysson = json_encode($data);
echo $jaysson;
