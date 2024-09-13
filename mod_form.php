<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_checkpassword_mod_form extends moodleform_mod {
    public function definition() {
        $mform = $this->_form;

        // Ajouter un champ pour le nom de l'activité.
        $mform->addElement('text', 'name', get_string('activityname', 'mod_checkpassword'), array('size' => '64'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        // Éléments standard (ex. disponibilité, groupe, etc.).
        $this->standard_coursemodule_elements();

        // Boutons d'envoi.
        $this->add_action_buttons();
    }
}
