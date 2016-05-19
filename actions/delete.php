<?php

$guid = get_input('guid');

if ($guid) {
    $videos = get_entity($guid);
}

if (!$videos || !$videos instanceof ElggVideos || !$videos->canEdit()) {
    register_error(elgg_echo('InvalidParameterException:NoEntityFound'));
    forward(REFERER);
}

$videos->delete();

system_message('videos:deleted');
forward('/videos');