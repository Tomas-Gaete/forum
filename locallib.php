<?php
//most functions used in the plugin are handled here
function get_all_forum_data() {
    global $DB;
    return $DB->get_records('forum_data');
}
function get_all_input_data() {
    global $DB;
    return $DB->get_records('input_data');
}
function get_current_user_id(){
    global $USER;
    $user_id = $USER->id;
    return $user_id;
}

function render_all_forum_data($all_data) {
    $forums = [];

    if (!empty($all_data)) {
        foreach ($all_data as $data) {
            $forum = [
                'title' => htmlspecialchars($data->title),//save all the data needed from forum_data table
                'theme' => htmlspecialchars($data->theme),
                'intro' => htmlspecialchars($data->intro),
                'criteria' => htmlspecialchars($data->criteria),
                'info' => htmlspecialchars($data->info),
                'id' => htmlspecialchars($data->id),
                'forum_id' => $data->id
            ];
            
            $to_form = array('my_array' => array('id' => $forum['forum_id'])); 
            $mform = new simplehtml_input(null,$to_form);

            if ($mform->is_cancelled()) {
                //handle cancelation
                redirect(new moodle_url('/local/forum/index.php')); // Redirect to the main page
            } elseif ($data_form = $mform->get_data()) {
                //handle form submission
                $mform->submit($data_form, null);
                redirect(new moodle_url('/local/forum/final_view.php')); // Redirect to final page
            }

            $forum['inputs'] = $mform->render(); //add the forms to every instance of the array
            $forums[] = $forum;
        }
    }
        return $forums;
}

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

class simplehtml_input extends moodleform {
    // Add elements to the form.
    public function definition() {

        $mform = $this->_form; 
        $mform->addElement('textarea', 'answer', get_string('input_answer', 'local_forum'));
        $mform->addElement('hidden', 'forum_id', $this->_customdata['my_array']['id']);
        $mform->setType('forum_id', PARAM_INT);
        $mform->addElement('hidden', 'submit_time', '0');
        $mform->setType('submit_time', PARAM_INT);
        $mform->addElement('hidden', 'user_id', '0');
        $mform->setType('user_id', PARAM_INT);
        //Add  action buttons 
        $this->add_action_buttons(true, get_string('submit_button', 'local_forum'));
    }
    
    
    function submit($data_form, $files) {
        // set the data to the desired values and insert it to the (mdl_) input_data table
        global $DB;
        $input_data = new stdClass();
        $input_data->answer = $data_form->answer;
        $input_data->forum_id = $data_form->forum_id;
        $input_data->submit_time = time();
        $input_data->user_id = get_current_user_id();
        $DB->insert_record('input_data', $input_data);
    }
    // If necesary custom validation can be added here
    function validation($data_form, $files) {
        return [];
    }
}
function render_all_input_data($all_data) {
    $answers = [];

    if (!empty($all_data)) {
        foreach ($all_data as $data) {
            $input = [
                'answer' => htmlspecialchars($data->answer),//save all the data needed from forum_data table
                'forum_id' => htmlspecialchars($data->forum_id),
                'submit_time' => htmlspecialchars(gmdate("Y-m-d\ T H:i:s", $data->submit_time)),
                'user' => htmlspecialchars($data->user_id),
            ];
            
            //$to_form = array('my_array' => array('id' => $forum['forum_id'])); 
            $answers[] = $input;
        }
    }
        return $answers;
}