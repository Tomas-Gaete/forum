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
    
    if ($oldversion < 2024010302) {
        $table = new xmldb_table('forum_data');
        
        $table-> add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table-> add_field('title',XMLDB_TYPE_CHAR, '45', null, XMLDB_NOTNULL, null, null);
        $table-> add_field('theme',XMLDB_TYPE_CHAR, '45', null, XMLDB_NOTNULL, null, null);
        $table-> add_field('criteria',XMLDB_TYPE_CHAR, '45', null, XMLDB_NOTNULL, null, null);
        $table-> add_field('info',XMLDB_TYPE_CHAR, '45', null, XMLDB_NOTNULL, null, null);
        $table-> add_field('from',XMLDB_TYPE_DATETIME, '45', null, XMLDB_NOTNULL, null, null);
        $table-> add_field('to',XMLDB_TYPE_DATETIME, '45', null, XMLDB_NOTNULL, null, null);
    }

    // For further information please read {@link https://docs.moodle.org/dev/Upgrade_API}.
    //
    // You will also have to create the db/install.xml file by using the XMLDB Editor.
    // Documentation for the XMLDB Editor can be found at {@link https://docs.moodle.org/dev/XMLDB_editor}.

    return true;
}
