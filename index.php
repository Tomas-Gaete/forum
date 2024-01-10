<?php
require_once('../../config.php');
global $PAGE, $OUTPUT;
require_login();
$PAGE->set_url(new moodle_url('/local/forum/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('pluginname', 'local_forum'));

$myCustomURL = new moodle_url('/local/forum/create_forum.php'); // array('id' => 2) Redirects to course with id 2
$myCustomURL2 = new moodle_url('/local/forum/view_forums.php'); // array('id' => 2) Redirects to course with id 2

$templatecontext = array(
    'main' => true,    
);

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_forum/app', $templatecontext);
echo '<div class="container text-center">';
echo $OUTPUT->single_button($myCustomURL, get_string('Button', 'local_forum'));
echo $OUTPUT->single_button($myCustomURL2, get_string('skip', 'local_forum'));
echo '</div>';

echo $OUTPUT->footer();