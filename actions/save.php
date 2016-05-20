<?php

$guid = get_input('guid');
$title = get_input('title');

$urls = get_input('urls');
$titles = get_input('titles');
$tags = string_to_tag_array(get_input('tags'));


$container_guid = (int) get_input('container_guid');
$access_id = (int) get_input('access_id');

elgg_make_sticky_form('videos');

if ($guid) {
    $videos = get_entity($guid);
    if (!$videos || !$videos instanceof ElggVideos || !$videos->canEdit()) {
        register_error(elgg_echo('InvalidParameterException:NoEntityFound'));
        forward(REFERER);
    }
} else {
    $videos = new ElggVideos();
}

if (!$title) {
    register_error(elgg_echo('videos:title:missing'));
    forward(REFERER);
}

$videos->title = $title;

$videos->titles = $titles;
$videos->urls = $urls;

$videos->container_guid = $container_guid;
$videos->access_id = $access_id;
$videos->tags = $tags;
$videos->save();

elgg_clear_sticky_form('videos');
system_message('videos:saved');
forward('/videos');