<?php

function get_forum_data_by_id($id) {
    global $DB;
    return $DB->get_record('forum_data', array('id' => $id));
}
function get_all_forum_data() {
    global $DB;
    return $DB->get_records('forum_data');
}
function get_current_user_id(){
    global $DB;
    global $USER;
    $user_id = $USER->id;
    return $user_id;
}

/*function get_forum_id($x){
    global $DB;
    $forum_id = $x;
    return $forum_id;
}*/

function render_all_forum_data($all_data) {
    $forums = [];

    if (!empty($all_data)) {
        foreach ($all_data as $data) {
            $forum = [
                'title' => htmlspecialchars($data->title),
                'theme' => htmlspecialchars($data->theme),
                'intro' => htmlspecialchars($data->intro),
                'criteria' => htmlspecialchars($data->criteria),
                'info' => htmlspecialchars($data->info),
                'id' => htmlspecialchars($data->id),
                'forum_id' => $data->id
            ];
            $forum_id = $data->id;
            // Assuming simplehtml_input is a form class
            $to_form = array('my_array' => array('id' => $forum['forum_id'])); 
            $mform = new simplehtml_input(null,$to_form);

            if ($mform->is_cancelled()) {
                // Handle cancellation
                redirect(new moodle_url('/local/forum/index.php')); // Redirect to the main page, adjust the URL as needed
            } elseif ($data_form = $mform->get_data()) {
                // Handle form submission data_form
                // You can process the form data_form here 
                $mform->submit($data_form, null);
                redirect(new moodle_url('/local/forum/index.php')); // Redirect to the main page, adjust the URL as needed
            }

            $forum['inputs'] = $mform->render(); 
            $forums[] = $forum;
        }
    }
        return $forums;
}
class simplehtml_input extends moodleform {
    // Add elements to form.
    public function definition() {

        $mform = $this->_form; 
        $mform->addElement('textarea', 'answer', get_string('input_answer', 'local_forum'));
        $mform->addElement('hidden', 'forum_id', $this->_customdata['my_array']['id']);
        $mform->setType('forum_id', PARAM_INT); // Set the type to PARAM_INT to ensure it's an integer
        $mform->addElement('hidden', 'submit_time', '0');
        $mform->setType('submit_time', PARAM_INT); // Set the type to PARAM_INT to ensure it's an integer
        $mform->addElement('hidden', 'user_id', '0');
        $mform->setType('user_id', PARAM_INT); // Set the type to PARAM_INT to ensure it's an integer


        $this->add_action_buttons();
        // Set type of element.
    }
    function submit($data_form, $files) {
        // Perform database operations here
        global $DB;
        //$mform->setType('email', PARAM_NOTAGS);
        //$mform->setDefault('email', 'Please enter email');
        //die(var_dump($data_form));
        $input_data = new stdClass();
        $input_data->answer = $data_form->answer;
        $input_data->forum_id = $data_form->forum_id;
        //die(var_dump($input_data->forum_id)); 
        $input_data->submit_time = time();
        $input_data->user_id = get_current_user_id();
    $DB->insert_record('input_data', $input_data);
    redirect(new moodle_url('/local/forum/index.php'));
    }
    // Custom validation should be added here.
    function validation($data_form, $files) {
        return [];
    }
}
function get_forum_ids($all_data) {
    $forum_ids = [];

    if (!empty($all_data)) {
        foreach ($all_data as $data) {
            $forum_ids[] = htmlspecialchars($data->id);
        }
    }

    return $forum_ids;
}