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
                'id' => htmlspecialchars($data->id)
                // Add any other fields you need here
            ];

            // Assuming simplehtml_input is a form class
            $mform = new simplehtml_input();

            if ($mform->is_cancelled()) {
                // Handle cancellation
                redirect(new moodle_url('/local/forum/index.php')); // Redirect to the main page, adjust the URL as needed
            } elseif ($data = $mform->get_data()) {
                // Handle form submission data
                // You can process the form data here
                //$data->$forum_id = $forums['id'];
                $mform->submit($data, null);
                redirect(new moodle_url('/local/forum/index.php')); // Redirect to the main page, adjust the URL as needed
            }

            $forum['inputs'] = $mform->render(); // Add the form to the forum data
            $forums[] = $forum;
        }
    }
        return $forums;
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