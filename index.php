<?php
require_once('../../config.php');
global $PAGE, $OUTPUT;
require_login();
$PAGE->set_url(new moodle_url('/local/forum/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('pluginname', 'local_forum'));

$myCustomURL = new moodle_url('/local/forum/create_forum.php'); // array('id' => 2) Redirects to course with id 2
$templatecontext = array(
    'main' => true,    
);

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_forum/app', $templatecontext);
echo $OUTPUT->single_button($myCustomURL, get_string('Button', 'local_forum'));
//echo html_writer::link($myCustomURL, get_string('gotocourse', 'local_yourplugin')); forma para generar hyperlinks generica

echo $OUTPUT->footer();