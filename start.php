<?php

elgg_register_event_handler('init', 'system', 'videos_init');

function videos_init() {
    elgg_register_entity_type('object', 'videos');
    elgg_register_page_handler('videos', 'videos_page_handler');

    elgg_register_action('videos/save', dirname(__FILE__) . "/actions/save.php");
    elgg_register_action('videos/delete', dirname(__FILE__) . "/actions/delete.php");

    elgg_register_plugin_hook_handler('container_permissions_check', 'all', 'videos_container_permissions_check');
}

function videos_page_handler($segments) {
    switch($segments[0]) {
        case "add":
            include(dirname(__FILE__) . "/pages/edit.php");

            break;
        case "edit":
            set_input('guid', $segments[1]);
            include(dirname(__FILE__) . "/pages/edit.php");
            break;
        case "all":
        default:
            include(dirname(__FILE__) . "/pages/all.php");
            break;
    }

    return true;
}

function videos_container_permissions_check($hook, $type, $return_value, $params) {
    $user = elgg_extract('user', $params);
    $container = elgg_extract('container', $params);
    $subtype = elgg_extract('subtype', $params);

    if (!$subtype == "videos") {
        return $return_value;
    }

    if ($user && $user->isAdmin()) {
        return true;
    } else {
        return false;
    }
}