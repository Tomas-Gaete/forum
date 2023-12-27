<?php
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $ADMIN->add('localplugins', new admin_externalpage('local_forum', get_string('pluginname', 'local_forum'), "$CFG->wwwroot/local/forum/index.php"));
}

?>