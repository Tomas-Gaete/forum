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
/*
class simplehtml_input extends moodleform {
    // Add elements to form.
    public function definition() {

        $mform = $this->_form; 
        $mform->addElement('textarea', 'answer', get_string('input_answer', 'local_forum'));
        $mform->addElement('hidden', 'forum_id', '0');
        $mform->setType('forum_id', PARAM_INT); // Set the type to PARAM_INT to ensure it's an integer
        $mform->addElement('hidden', 'submit_time', '0');
        $mform->setType('submit_time', PARAM_INT); // Set the type to PARAM_INT to ensure it's an integer
        $mform->addElement('hidden', 'user_id', '0');
        $mform->setType('user_id', PARAM_INT); // Set the type to PARAM_INT to ensure it's an integer


        $this->add_action_buttons();
        // Set type of element.
    }
    function submit($data, $files,$forum_id) {
        // Perform database operations here
        global $DB;
        //$mform->setType('email', PARAM_NOTAGS);
        //$mform->setDefault('email', 'Please enter email');

        $input_data = new stdClass();
        $input_data->answer = $data->answer;
        $input_data->forum_id =submit_id($forum_id);
        $input_data->submit_time = time();
        $input_data->user_id = get_current_user_id();
    $DB->insert_record('input_data', $input_data);
    redirect(new moodle_url('/local/forum/index.php'));
    }
    // Custom validation should be added here.
    function validation($data, $files) {
        return [];
    }
}*/

// Rest of your code for rendering




$templatecontext = array(
    'view' => true,
    'forums' => $forums,
    
);

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_forum/app', $templatecontext);
echo $OUTPUT->single_button($myCustomURL, get_string('view_button', 'local_forum'));
echo $OUTPUT->single_button($myCustomURL2, get_string('view_button', 'local_forum'));
echo $OUTPUT->footer();