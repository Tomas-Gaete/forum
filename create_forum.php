<?php
require_once('../../config.php');
require_once("$CFG->libdir/formslib.php");
global $PAGE, $OUTPUT;
require_login();
$PAGE->set_url(new moodle_url('/local/forum/create_forum.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('pluginname', 'local_forum'));


class simplehtml_form extends moodleform {
    // Add elements to form.
    public function definition() {
        // A reference to the form is stored in $this->form.
        // A common convention is to store it in a variable, such as `$mform`.
        $mform = $this->_form; // Don't forget the underscore!

        // Add elements to your form.
        $mform->addElement('text', 'name', get_string('form_title', 'local_forum'));
        $mform->addElement('textarea', 'introduction', get_string('form_intro', 'local_forum'), 'wrap="virtual" rows="10" cols="10"');
        $mform->addElement('text', 'name', get_string('criteria', 'local_forum'));
        $mform->addElement('text', 'name', get_string('bibliography', 'local_forum'));
        $mform->addElement('date_time_selector', 'assesstimestart', get_string('from'));
        $mform->addElement('date_selector', 'assesstimefinish', get_string('to'));

        //$mform->addElement('checkbox', 'ratingtime', get_string('ratingtime', 'forum'));

        //$mform->addElement('button', 'intro', get_string('form_Btn', 'local_forum'));

        $this->add_action_buttons();
        // Set type of element.
        $mform->setType('email', PARAM_NOTAGS);

        // Default value.
        $mform->setDefault('email', 'Please enter email');
    }

    // Custom validation should be added here.
    function validation($data, $files) {
        return [];
    }
}

$mform = new simplehtml_form();
if ($mform->is_cancelled()) {
    // Handle cancellation
    redirect(new moodle_url('/index.php')); // Redirect to the main page, adjust the URL as needed
} elseif ($data = $mform->get_data()) {
    // Handle form submission data
    // You can process the form data here
    // Redirect or display a message based on your needs
    redirect(new moodle_url('/index.php')); // Redirect to the main page, adjust the URL as needed
}

$templatecontext = array(
    'Btn' => true,
);
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_forum/app', $templatecontext);
$mform->display();
echo $OUTPUT->footer();