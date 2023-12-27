<?php
require_once('../../config.php');
require_login();

$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('pluginname', 'local_forum'));

echo $OUTPUT->header();
echo '<div class="content">' . get_string('titulo', 'local_forum') . '</div>';
echo $OUTPUT->footer();