<?php
require_once('../../config.php');
require_once("$CFG->libdir/formslib.php");
require_once(__DIR__ . '/locallib.php');
global $PAGE, $OUTPUT;
require_login();
$PAGE->set_url(new moodle_url('/local/forum/view_forums.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('create_title', 'local_forum'));

$myCustomURL = new moodle_url('/local/forum/index.php'); // array('id' => 2) Redirects to course with id 2



$forums_with_forms = [];

foreach ($all_forum_data as $forum) {
    $mform = new simplehtml_form();

    // Assuming you want to pass the forum's ID to the form
    // You might need to modify your form class to accept parameters
    $mform->set_data(['forum_id' => $forum->id]);

    // Render the form to a string
    ob_start();
    $mform->display();
    $form_html = ob_get_clean();

    // Add the form's HTML to the forum object
    $forum->form_html = $form_html;

    $forums_with_forms[] = $forum;
}

$templatecontext = array(
    'view' => true,
    'forums' => $forums_with_forms,
);

$all_forum_data = get_all_forum_data();
$forums = render_all_forum_data($all_forum_data);
$templatecontext = array(
    'view' => true,
    'forums' => $forums
    
);

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_forum/app', $templatecontext);
echo $OUTPUT->single_button($myCustomURL, get_string('view_button', 'local_forum'));
echo $OUTPUT->footer();