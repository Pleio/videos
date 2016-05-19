<?php
gatekeeper();

$videos = elgg_extract("entity", $vars);

if ($videos) {
    echo elgg_view("input/hidden", array("name" => "guid", "value" => $videos->guid));
    $titles = $videos->titles;
    $urls = $videos->urls;
} else {
    $titles = array();
    $urls = array();
}

$user = elgg_get_logged_in_user_entity();
$containers = array();
foreach ($user->getGroups(array(), 50) as $group) {
    $containers[$group->guid] = $group->name;
}

?>

<div>
    <label for="title"><?php echo elgg_echo("videos:title"); ?></label><br />
    <div>
    <?php echo elgg_view('input/text', array(
        'name' => 'title',
        'value' => elgg_get_sticky_value('videos', 'title', $videos->title)
    )); ?>
    </div>
</div><br />

<div>
    <label><?php echo elgg_echo("videos:urls"); ?></label><br />
    <?php for ($i = 0; $i < 10; $i++) {
        echo "<div>";
        echo elgg_view('input/text', array(
            'name' => 'titles[' . $i . ']',
            'placeholder' => elgg_echo('title') . " " . ($i+1),
            'value' => elgg_get_sticky_value('titles', 'titles[' . $i . ']', $titles[$i])
        ));
        echo elgg_view('input/text', array(
            'name' => 'urls[' . $i . ']',
            'placeholder' => elgg_echo('videos:url') . " " . ($i+1),
            'value' => elgg_get_sticky_value('urls', 'urls[' . $i . ']', $urls[$i])
        ));
        echo "</div><br />";
    } ?>
</div>

<div>
    <label for="container_guid"><?php echo elgg_echo("videos:container"); ?></label><br />
    <div>
    <?php echo elgg_view('input/dropdown', array(
        'name' => 'container_guid',
        'options_values' => $containers,
        'value' => elgg_get_sticky_value('videos', 'container_guid', $videos->container_guid)
    )); ?>
    </div>
</div><br />

<div>
    <label for="tags"><?php echo elgg_echo("tags"); ?></label><br />
    <?php echo elgg_view('input/tags', array(
        'name' => 'tags',
        'value' => elgg_get_sticky_value('videos', 'tags', $videos->tags)
    )); ?>
</div><br />

<div>
    <label for="tags"><?php echo elgg_echo("access"); ?></label><br />
    <?php echo elgg_view('input/access', array(
        'name' => 'access_id',
        'value' => ($videos->access_id) ? $videos->access_id : get_default_access()
    )); ?>
</div><br />

<?php
echo elgg_view("input/submit", array(
    'value' => ($videos) ? elgg_echo('edit') : elgg_echo('add')
));