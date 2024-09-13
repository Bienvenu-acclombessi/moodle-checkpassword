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
 * TODO describe file lib
 *
 * @package    core
 * @copyright  2024 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

function checkpassword_get_coursemodule_info($coursemodule) {
    global $DB;

    // Récupérer les informations de l'instance de l'activité checkpassword.
    $instance = $DB->get_record('checkpassword', array('id' => $coursemodule->instance), '*', MUST_EXIST);

    $info = new cached_cm_info();
    
    // Utiliser le champ 'name' de l'instance de l'activité.
    $info->name = $instance->name;

    // Ajouter d'autres informations nécessaires ici si besoin.
    
    return $info;
}



/**
 * Crée une nouvelle instance de l'activité checkpassword.
 * @param stdClass $data
 * @param mod_checkpassword_mod_form $form
 * @return int
 */
function checkpassword_add_instance($data, $form = null) {
    global $DB;
    $data->timecreated = time();
    return $DB->insert_record('checkpassword', $data);
}

/**
 * Met à jour une instance existante de l'activité checkpassword.
 * @param stdClass $data
 * @param mod_checkpassword_mod_form $form
 * @return bool
 */
function checkpassword_update_instance($data, $form = null) {
    global $DB;

    $data->timemodified = time();
    $data->id = $data->instance;
    
    return $DB->update_record('checkpassword', $data);
}


/**
 * Supprime une instance existante de l'activité checkpassword.
 * @param int $id
 * @return bool
 */
function checkpassword_delete_instance($id) {
    global $DB;

    if (!$record = $DB->get_record('checkpassword', array('id' => $id))) {
        return false;
    }

    // Supprimer l'instance de la base de données.
    $DB->delete_records('checkpassword', array('id' => $id));

    return true;
}
