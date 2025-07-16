<?php

# $menuEntries is an array of menu entries for this plugin
# text - menu entry text
# type - status/content/output/help (main menu area)
# page - PHP or HTML file to display for this menu item
# wrap - 0/1 to hide or display the FPP header, menu, and footer on this page.

$menuEntries = Array(
    Array(
        'text' => 'Scoreboard Config',
        'type' => 'status',
        'page' => 'scoreboard.html',  // <--- this is your main UI
        'wrap' => 1
    ),
    Array(
        'text' => 'Scoreboard Status (JSON)',
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

##############################################################################
# Display the menu entries for this plugin.

foreach ($menuEntries as $entry)
{
    if ($entry['type'] != $menu)
        continue;

    if (preg_match('/^http.?:\/\//', $entry['page']))
    {
        printf("<li><a href='%s' target='_blank'>%s</a></li>\n",
            $entry['page'], $entry['text']);
    }
    else
    {
        $nopage = '';
        if (isset($entry['wrap']) && ($entry['wrap'] == 0))
            $nopage = '&nopage=1';

        printf("<li><a href='plugin.php?plugin=%s&page=%s%s'>%s</a></li>\n",
            $plugin, $entry['page'], $nopage, $entry['text']);
    }
}

?>
