<?php
require_once('../../config.php');
require_once("$CFG->libdir/formslib.php");
require_once(__DIR__ . '/locallib.php');

global $PAGE, $OUTPUT, $DB;
require_login();
$PAGE->set_url(new moodle_url('/local/forum/final_view.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('create_title', 'local_forum'));

$myCustomURL = new moodle_url('/local/forum/index.php'); //link to main page
$myCustomURL2 = new moodle_url('/local/forum/view_answers.php'); //link to main page

$return_button = $OUTPUT->single_button($myCustomURL, get_string('final_button', 'local_forum'));
$answers_button = $OUTPUT->single_button($myCustomURL2, get_string('go_to_answers', 'local_forum'));

$templatecontext = array(
    'fin' => true,
    'return_button' => $return_button, //we send the data from the button
    'go_to_answers' => $answers_button
);
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_forum/app', $templatecontext);
echo $OUTPUT->footer();