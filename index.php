<?php

require_once('../../config.php');

$id = required_param('id', PARAM_INT); // ID du cours.

$cm = get_coursemodule_from_id('checkpassword', $id, 0, false, MUST_EXIST);
redirect(new moodle_url('/mod/checkpassword/view.php', array('id' => $id)));
