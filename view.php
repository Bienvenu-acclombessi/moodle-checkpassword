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
 * Plugin version and other meta-data are defined here.
 *
 * @package     mod_checkpassword
 * @copyright   2024 Bienvenu ACCLOMBESSI <bienvenuacclombessi8@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/mod/checkpassword/lib.php');

// Récupérer les informations du module et de l'instance
$id = required_param('id', PARAM_INT); // ID du cours_module

if (!$cm = get_coursemodule_from_id('checkpassword', $id)) {
    print_error('invalidcoursemodule');
}
// Récupération du contexte et du module
$cm = get_coursemodule_from_id('checkpassword', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$checkpassword = $DB->get_record('checkpassword', array('id' => $cm->instance), '*', MUST_EXIST);

// Vérification des capacités
require_login($course, true, $cm);
$context = context_module::instance($cm->id);

// Mise en place de la page
$PAGE->set_url('/mod/checkpassword/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($checkpassword->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);

// Inclusion des fichiers CSS et JS
$PAGE->requires->css('/mod/checkpassword/style.css');
$PAGE->requires->js('/mod/checkpassword/script.js');

// Début de la sortie
echo $OUTPUT->header();

// Affichage du titre de l'activité
// echo $OUTPUT->heading(format_string($checkpassword->name), 2);
?>
<form action="#" id="check_password_form">


    <div class="check_password_password-container">
        <h1 class="check_password_heading" > <?=get_string('check_password_heading','checkpassword') ?> </h1>
        <p> <?=get_string('check_password_description','checkpassword') ?>  </p>
        <div class="check_password_password_input_div">
            <input type="text" id="check_password_password" autocomplete="off" class="check_password_password-input"
                placeholder="<?=get_string('check_password_input_placeholder','checkpassword') ?>">
            <span class="check_password_password-toggle" onclick="togglePasswordVisibility()"> <i
                    class="fa fa-eye"  id="check_password_toggle-icon" ></i></span>
        </div>
        <div class="check_password_password-strength">
            <div id="check_password_strength-bar" class="check_password_password-strength-bar"></div>
        </div>
        <div class="check_password_messages check_password_hidden" id="check_password_messages" >
            <ul class="check_password_password-requirements">
                <li id="check_password_length" class=""> <i class="fas fa-times"></i> <?=get_string('check_password_status_length','checkpassword') ?> </li>
                <li id="check_password_uppercase" class=""> <i class="fas fa-times"></i> <?=get_string('check_password_status_uppercase','checkpassword') ?> </li>
                <li id="check_password_number" class=""> <i class="fas fa-times"></i> <?=get_string('check_password_status_number','checkpassword') ?></li>
                <li id="check_password_special" class=""> <i class="fas fa-times"></i> <?=get_string('check_password_status_special','checkpassword') ?></li>
            </ul>
            <p id="check_password_status"> </p>
        </div>

       
        <div>
            <button type="submit" class="btn btn-primary"> <?=get_string('check_password_submit_btn','checkpassword') ?>  </button>
        </div>

    </div>
</form>
<?php
// Affichage du pied de page
echo $OUTPUT->footer();