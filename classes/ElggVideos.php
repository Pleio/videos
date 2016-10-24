<?php
class ElggVideos extends ElggObject {
    const SUBTYPE = "videos";

    protected function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes["subtype"] = self::SUBTYPE;
    }

    public function getVideos() {
        $videos = array();
        foreach ($this->urls as $i => $url) {
            if ($url) {
                $videos[] = $this->getVideoFromURL($this->titles[$i], $url);
            }
        }

        return $videos;
    }

    public function getFirstVideo() {
        if ($this->urls[0]) {
            return $this->getVideoFromURL($this->titles[0], $this->urls[0]);
        }

        return null;
    }

    private function getVideoFromURL($title, $url) {
        $url = parse_url($url);
        parse_str($url["query"], $query);

        if (strpos($url["host"], "youtube.com") !== false) {
            $source = "youtube";
            $id = $query["v"];
            $thumb = "https://img.youtube.com/vi/" . $id . "/hqdefault.jpg";
        }

        if ($source && $id && $thumb) {
            return VideoSource::create($title, $source, $id, $thumb);
        }

        return null;
    }
}