<?php
require_once('../../config.php');
require_once("$CFG->libdir/formslib.php");
global $PAGE, $OUTPUT;
require_login();
$PAGE->set_url(new moodle_url('/local/forum/view_forums.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('create_title', 'local_forum'));

$myCustomURL = new moodle_url('/local/forum/index.php'); // array('id' => 2) Redirects to course with id 2

$templatecontext = array(
    'view' => true,
);

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_forum/app', $templatecontext);
echo $OUTPUT->single_button($myCustomURL, get_string('view_button', 'local_forum'));
echo $OUTPUT->footer();