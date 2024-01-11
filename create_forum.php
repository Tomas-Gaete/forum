<?php
require_once('../../config.php'); //set up basics for the page
require_once("$CFG->libdir/formslib.php");
require_once(__DIR__ . '/locallib.php');

global $PAGE, $OUTPUT;
require_login();
$PAGE->set_url(new moodle_url('/local/forum/create_forum.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('create_title', 'local_forum'));

$mform = new simplehtml_form();
if ($mform->is_cancelled()) {
    // Handle cancellation
    redirect(new moodle_url('/local/forum/index.php'));; // Redirect to the main page, adjust the URL as needed
} elseif ($data = $mform->get_data()) {
    //handle form submission
    $mform->submit($data, null);
    redirect(new moodle_url('/local/forum/view_forums.php'));; // Redirect to the view page, adjust the URL as needed
}
$templatecontext = array(
    'Create' => true,
);
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_forum/app', $templatecontext);
$mform->display();
echo $OUTPUT->footer();