<?php
require_once('../../config.php');
require_once("$CFG->libdir/formslib.php");
require_once(__DIR__ . '/locallib.php');

global $PAGE, $OUTPUT;
require_login();
$PAGE->set_url(new moodle_url('/local/forum/create_forum.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('create_title', 'local_forum'));


class simplehtml_form extends moodleform {
    // Add elements to form.
    public function definition() {
        // A reference to the form is stored in $this->form.
        // A common convention is to store it in a variable, such as `$mform`.
        $mform = $this->_form; // Don't forget the underscore!

        // Add elements to your form.
        $mform->addElement('text', 'title', get_string('form_title', 'local_forum'));
        $mform->addElement('text', 'theme', get_string('form_theme', 'local_forum'));
        //$mform->addHelpButton('theme', 'form_theme_help', 'local_forum');//no crear obligación pq aun no sirve el manejo de los datos
        //$mform->addRule('theme', get_string('required'), 'required', null, 'client');
        $mform->addElement('textarea', 'introduction', get_string('form_intro', 'local_forum'), 'wrap="virtual" rows="10" cols="10"');
        $mform->addElement('text', 'crit', get_string('criteria', 'local_forum'));
        $mform->addElement('text', 'info', get_string('bibliography', 'local_forum'));
        $mform->addElement('date_time_selector', 'assesstimestart', get_string('start_date','local_forum'));
        $mform->addElement('date_time_selector', 'assesstimefinish', get_string('end_date','local_forum'));
        $mform->addElement('filepicker', 'attachment', get_string('form_archive', 'local_forum'), null, array('accepted_types' => '*'));
        

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

        $forum_data = new stdClass();
        $forum_data->title = $data->title;
        $forum_data->theme = $data->theme;
        $forum_data->intro = $data->introduction;
        $forum_data->criteria = $data->crit;
        $forum_data->info = $data->info;
        //$forum_data->archive = $data->info;
        $forum_data->start_date = $data->assesstimestart;
        $forum_data->end_date = $data->assesstimefinish;
        $forum_data->user_id = get_current_user_id();


    $DB->insert_record('forum_data', $forum_data);
    redirect(new moodle_url('/local/forum/view_forums.php'));
    }
    // Custom validation should be added here.
    function validation($data, $files) {
        return [];
    }
}

$mform = new simplehtml_form();
if ($mform->is_cancelled()) {
    // Handle cancellation
    redirect(new moodle_url('/local/forum/index.php'));; // Redirect to the main page, adjust the URL as needed
} elseif ($data = $mform->get_data()) {
    // Handle form submission data
    // You can process the form data here
    $mform->submit($data, null);
    redirect(new moodle_url('/local/forum/view_forums.php'));; // Redirect to the main page, adjust the URL as needed
}

$templatecontext = array(
    'Create' => true,
);
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_forum/app', $templatecontext);
$mform->display();
echo $OUTPUT->footer();