<?php

function get_forum_data_by_id($id) {
    global $DB;
    return $DB->get_record('forum_data', array('id' => $id));
}
function get_all_forum_data() {
    global $DB;
    return $DB->get_records('forum_data');
}

function render_forum_data($data) {
    if (!$data) {
        return 'Data not found.';
    }

    $output = '';
    $output .= 'Title: ' . htmlspecialchars($data->title) . '<br>';
    $output .= 'Theme: ' . htmlspecialchars($data->theme) . '<br>';
    $output .= 'intro: ' . htmlspecialchars($data->intro) . '<br>';
    $output .= 'criteria: ' . htmlspecialchars($data->criteria) . '<br>';
    $output .= 'info: ' . htmlspecialchars($data->info) . '<br>';
    $output .= 'id: ' . htmlspecialchars($data->id) . '<br>';


    return $output;
}
function render_all_forum_data($all_data) {
    $forums = [];

    if (!empty($all_data)) {
        foreach ($all_data as $data) {
            $forum = new stdClass();
            $forum->title = htmlspecialchars($data->title);
            $forum->theme = htmlspecialchars($data->theme);
            $forum->intro = htmlspecialchars($data->intro);
            $forum->criteria = htmlspecialchars($data->criteria);
            $forum->info = htmlspecialchars($data->info);
            $forum->id = htmlspecialchars($data->id);
            // Add any other fields you need here
            $forums[] = $forum;
            $forums_id[] =htmlspecialchars($data->id);
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