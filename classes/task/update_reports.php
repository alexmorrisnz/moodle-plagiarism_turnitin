<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Update report Scores from Turnitin.
 *
 * @package    plagiarism_turnitin
 * @author     John McGettrick http://www.turnitin.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace plagiarism_turnitin\task;

use plagiarism_plugin_turnitin;

defined('MOODLE_INTERNAL') || die();

/**
 * Update report Scores from Turnitin.
 */
class update_reports extends \core\task\scheduled_task {

    public function get_name() {
        return get_string('updatereportscores', 'plagiarism_turnitin');
    }

    public function execute() {
        global $CFG, $pptaskcall;

        // Call plagiarism turnitin cron function to update report scores.
        require_once($CFG->dirroot.'/plagiarism/turnitin/lib.php');
        $config = plagiarism_plugin_turnitin::plagiarism_turnitin_admin_config();
        if (empty($config->plagiarism_turnitin_accountid) || empty($config->plagiarism_turnitin_secretkey)) {
            return;
        }
        $pptaskcall = true;
        plagiarism_turnitin_update_reports();
    }
}