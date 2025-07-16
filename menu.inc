<?php

$menuEntries = Array(
    Array(
        'text' => 'Scoreboard Config',
        'type' => 'status',
        'page' => 'status.php',
        'wrap' => 1
    ),
    Array(
        'text' => 'Scoreboard - Help',
        'type' => 'help',
        'page' => 'help/help.php',
        'wrap' => 1
    ),
    Array(
        'text' => 'Scoreboard - About',
        'type' => 'help',
        'page' => 'about.php',
        'wrap' => 1
    )
);

foreach ($menuEntries as $entry)
{
    if ($entry['type'] != $menu)
        continue;

    $nopage = (isset($entry['wrap']) && ($entry['wrap'] == 0)) ? '&nopage=1' : '';

    printf("<li><a href='plugin.php?plugin=%s&page=%s%s'>%s</a></li>\n",
        $plugin, $entry['page'], $nopage, $entry['text']);
}
?>
