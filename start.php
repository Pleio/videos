<?php

elgg_register_event_handler('init', 'system', 'videos_init');

function videos_init() {
    elgg_register_entity_type('object', 'video');
}