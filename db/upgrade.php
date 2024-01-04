<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin upgrade steps are defined here.
 *
 * @package     local_forum
 * @category    upgrade
 * @copyright   2023 Tomás Gaete<togaete@alumnos.uai.cl>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__.'/upgradelib.php');

/**
 * Execute local_forum upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_local_forum_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();
    
    if ($oldversion < 2024010410) {

        // Define field start_date to be added to forum_data.
        $table = new xmldb_table('forum_data');
        $field = new xmldb_field('start_date', XMLDB_TYPE_INTEGER, '11', null, null, null, '0', 'info');

        // Conditionally launch add field start_date.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        // Define field end_date to be added to forum_data.
        $table = new xmldb_table('forum_data');
        $field = new xmldb_field('end_date', XMLDB_TYPE_INTEGER, '11', null, null, null, '0', 'start_date');

        // Conditionally launch add field end_date.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Forum savepoint reached.
        upgrade_plugin_savepoint(true, 2024010410, 'local', 'forum');
    }

    return true;
}
// For further information please read {@link https://docs.moodle.org/dev/Upgrade_API}.
    //
    // You will also have to create the db/install.xml file by using the XMLDB Editor.
    // Documentation for the XMLDB Editor can be found at {@link https://docs.moodle.org/dev/XMLDB_editor}.
