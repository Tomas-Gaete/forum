<?php
require_once('../../config.php');
require_once("$CFG->libdir/formslib.php");
require_once(__DIR__ . '/locallib.php');
require_once(__DIR__ . '/db/dbconfig.php');
require_once(__DIR__ . '/ajax/forum_answers.php');
//require_once(__DIR__ . '/ajax/submitAnswer.js'); 

global $PAGE, $OUTPUT;
$PAGE->requires->js(new moodle_url(__DIR__.'/submitAnswer.js'));
require_login();
$PAGE->set_url(new moodle_url('/local/forum/view_forums.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('create_title', 'local_forum'));

$myCustomURL = new moodle_url('/local/forum/index.php'); // array('id' => 2) Redirects to course with id 2

class simplehtml_input extends moodleform {
    // Add elements to form.
    public function definition() {
        // A reference to the form is stored in $this->form.
        // A common convention is to store it in a variable, such as `$mform`.
        $minput = $this->_form; // Don't forget the underscore!
        // Add elements to your form.
        $minput->addElement('text', 'answer', get_string('input_answer', 'local_forum'));
        

        

        //$mform->addElement('checkbox', 'ratingtime', get_string('ratingtime', 'forum'));

        //$mform->addElement('button', 'intro', get_string('form_Btn', 'local_forum'));

        $this->add_action_buttons();
        // Set type of element.
    }
    function submit($data, $files) {
        // Perform database operations here
        global $DB;
        //$mform->setType('email', PARAM_NOTAGS);
        //$mform->setDefault('email', 'Please enter email');

        $input_data = new stdClass();
        $input_data->answer = $data->answer;
        $input_data->forum_id =$data->forum_id;
        

    $DB->insert_record('input_data', $input_data);
    redirect(new moodle_url('/local/forum/index.php'));
    }
    // Custom validation should be added here.
    function validation($data, $files) {
        return [];
    }
}

$forums_with_forms = [];

foreach ($all_forum_data as $forum) {
    // Render the original form
    $mform = new simplehtml_form();
    $mform->set_data(['forum_id' => $forum->id]);
    ob_start();
    $mform->display();
    $form_html = ob_get_clean();
    $forum->form_html = $form_html;

    // Render the new input form
    $minput = new simplehtml_input();
    if ($minput->is_cancelled()) {
        // Handle cancellation
        redirect(new moodle_url('/local/forum/index.php'));; // Redirect to the main page, adjust the URL as needed
    } elseif ($data = $minput->get_data()) {
        // Handle form submission data
        // You can process the form data here
        $minput->submit($data, null);
        redirect(new moodle_url('/local/forum/index.php'));; // Redirect to the main page, adjust the URL as needed
    }
    $minput->set_data(['forum_id' => $data->id]); // If you need to pass forum ID or other data
    ob_start();
    $minput->display();
    $input_form_html = ob_get_clean();
    $forum->input_form_html = $input_form_html;

    $forums_with_forms[] = $forum;
}

// Rest of your code for rendering

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