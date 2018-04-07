<?php
require_once(dirname(dirname(__FILE__)) . "/wp-load.php");

if (!is_user_logged_in() || !current_user_can('manage_options')) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    wp_redirect(wp_login_url($actual_link));
    die();
}
$current_user = wp_get_current_user();
include('config/config.php');
global $map, $fork, $db;
$gymId = !empty($_POST['gymId']) ? $_POST['gymId'] : 0;
$gym = $db->get("forts", ['id'], ['external_id' => $gymId]);
$gymId = $gym['id'];

$data = $db->query('SELECT pokemon_id,username,user_id,timestamp FROM raids_info WHERE fort_id = :gymId ORDER BY timestamp DESC LIMIT 10', [':gymId' => $gymId])->fetchAll();

// also update fort_sightings so PMSF knows the gym has changed
// todo: put team stuff in here too


$jaysson = json_encode($data);
echo $jaysson;
