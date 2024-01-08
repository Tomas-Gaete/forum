<?php

function get_forum_data_by_id($id) {
    global $DB;
    return $DB->get_record('forum_data', array('id' => $id));
}
function get_all_forum_data() {
    global $DB;
    return $DB->get_records('forum_data');
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