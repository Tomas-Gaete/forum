<?php
require_once('../../config.php'); //set up basics for the page
require_once("$CFG->libdir/formslib.php");
require_once(__DIR__ . '/locallib.php');

global $PAGE, $OUTPUT;
require_login();
$PAGE->set_url(new moodle_url('/local/forum/view_forums.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('create_title', 'local_forum'));

$myCustomURL = new moodle_url('/local/forum/index.php');
$myCustomURL2 = new moodle_url('/local/forum/view_forums.php'); //link to view forums page
$home_button = $OUTPUT->single_button($myCustomURL, get_string('final_button', 'local_forum'));
$view_button = $OUTPUT->single_button($myCustomURL2, get_string('answer_again', 'local_forum'));

$all_input_data = get_all_input_data();
$answers = render_all_input_data($all_input_data);

$templatecontext = array(
    'ans' => true,//html in mustache that contains the main content for the index page 
    'answers' => $answers, //we send the data from the answers to the template
    'home_button' => $home_button,
    'forums_button' => $view_button
);

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_forum/app', $templatecontext);
echo $OUTPUT->footer();