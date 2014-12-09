<?php

require_once(dirname(dirname(__FILE__)) . '/../config.php');

require_login();
$context = context_system::instance();
require_capability('moodle/site:config', $context, $USER->id);
set_config('dummypla_use', 1, 'plagiarism');
redirect(new moodle_url('/admin/plagiarism.php'), 'No settings, dummy plugin is really dummy.');
