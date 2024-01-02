<?php
require_once('../../config.php');
global $PAGE, $OUTPUT;
require_login();
$PAGE->set_url(new moodle_url('/local/forum/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_forum'));
$PAGE->set_heading(get_string('pluginname', 'local_forum'));

$myCustomURL = new moodle_url('/local/forum/boton.php', array('id' => 2)); // Redirects to course with id 2

echo $OUTPUT->header();
echo '<div class="content">
<h2>' . get_string('titulo', 'local_forum') . '</h2>

<p>'. get_string('text', 'local_forum').' </p>
</div>';
echo $OUTPUT->single_button($myCustomURL, get_string('Button', 'local_forum'));
//echo html_writer::link($myCustomURL, get_string('gotocourse', 'local_yourplugin')); forma para generar hyperlinks generica

echo $OUTPUT->footer();