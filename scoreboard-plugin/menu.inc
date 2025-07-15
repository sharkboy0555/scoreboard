<?php
$pluginName = "scoreboard";  // must match your plugin folder name (case-sensitive)

$menu = array();

// This will create a top-level "Scoreboard" section in the FPP menu
$menu['Scoreboard'] = array(
    'index.html' => 'Dashboard'  // points to www/index.html
);

return $menu;
?>
