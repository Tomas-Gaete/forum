<?php
require_once('../../config.php');
require_once("$CFG->libdir/formslib.php");
require_once(__DIR__ . '/locallib.php');

//require_once(__DIR__ . '/ajax/submitAnswer.js'); 

global $PAGE, $OUTPUT, $DB;
require_login();
$PAGE->set_url(new moodle_url('/local/forum/view_forums.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('create_title', 'local_forum'));


$myCustomURL = new moodle_url('/local/forum/index.php'); // array('id' => 2) Redirects to course with id 2
$myCustomURL2 = new moodle_url('/local/forum/final_view.php'); // array('id' => 2) Redirects to course with id 2



$all_forum_data = get_all_forum_data();
$forums = render_all_forum_data($all_forum_data);




$templatecontext = array(
    'view' => true,
    'forums' => $forums,
    
);

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_forum/app', $templatecontext);
echo '<div class="container text-center">';
echo $OUTPUT->single_button($myCustomURL, get_string('view_button', 'local_forum'));
echo $OUTPUT->single_button($myCustomURL2, get_string('go_to_end_button', 'local_forum'));
echo '</div>';
echo $OUTPUT->footer();