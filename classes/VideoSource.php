<?php

class VideoSource {
    public static function create($title, $source, $id, $thumb) {
        return new VideoSource($title, $source, $id, $thumb);
    }

    public function __construct($title, $source, $id, $thumb) {
        $this->title = $title;
        $this->source = $source;
        $this->id = $id;
        $this->thumb = $thumb;
    }
}