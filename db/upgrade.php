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
    if ($oldversion<2024010411){
        $table = new xmldb_table('input_data');

        // Adding fields to table input_data.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('answer', XMLDB_TYPE_CHAR, '45', null, XMLDB_NOTNULL, null, 'no answer provided');

        // Adding keys to table input_data.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for input_data.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Forum savepoint reached.
        upgrade_plugin_savepoint(true, 2024010411, 'local', 'forum');


    }
    if ($oldversion < 2024010501) {

        // Define field forum_id to be added to input_data.
        $table = new xmldb_table('input_data');
        $field = new xmldb_field('forum_id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, null);
        $field_2 = new xmldb_field('submit_time', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, null, '0', null);



        // Conditionally launch add field forum_id.
        if (!$dbman->field_exists($table, $field,$field_2)) {
            $dbman->add_field($table, $field);
            $dbman->add_field($table, $field_2);
        }
        

        // Forum savepoint reached.
        upgrade_plugin_savepoint(true, 2024010501, 'local', 'forum');
    }



    return true;
}
// For further information please read {@link https://docs.moodle.org/dev/Upgrade_API}.
    //
    // You will also have to create the db/install.xml file by using the XMLDB Editor.
    // Documentation for the XMLDB Editor can be found at {@link https://docs.moodle.org/dev/XMLDB_editor}.
