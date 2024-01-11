<?php
require_once('../../config.php');
global $PAGE, $OUTPUT;
require_login();
$PAGE->set_url(new moodle_url('/local/forum/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('pluginname', 'local_forum'));

$myCustomURL = new moodle_url('/local/forum/create_forum.php'); //we create the link to the create forum page
$myCustomURL2 = new moodle_url('/local/forum/view_forums.php'); //we create the link to the view forums page

$create_button = $OUTPUT->single_button($myCustomURL, get_string('Button', 'local_forum'));
$view_button = $OUTPUT->single_button($myCustomURL2, get_string('skip', 'local_forum'));

$templatecontext = array(
    'main' => true,//html in mustache that contains the main content for the index page 
    'create_button' => $create_button, //we send the data from the buttons to the template
    'view_button' => $view_button   
);

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_forum/app', $templatecontext);
echo $OUTPUT->footer();