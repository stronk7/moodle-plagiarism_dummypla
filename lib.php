<?php

require_once($CFG->dirroot.'/plagiarism/lib.php');

defined('MOODLE_INTERNAL') || die;

/**
 * Now plagiarism_dummypla hooks into after_require_login
 */
function plagiarism_dummypla_after_require_login(
        $courseorid, $autologinguest=true, $cm=null,
        $setwantsurltome=true, $preventredirect=false) {

    if (!empty($cm) and strpos(me(), '/mod/') !== false) {
        $alreadynotified = true;
        \core\notification::warning('after_require_login @ plagiarism_dummypla intercepted this ' .
            $cm->get_module_type_name() . ' page!');
    }

}

class plagiarism_plugin_dummypla extends plagiarism_plugin {

    public function get_links($linkarray) {
        global $OUTPUT;
        $output = '';

        $ser = serialize($linkarray);
        if (stripos($ser, 'plagiarism') !== false) {
            $output = $OUTPUT->notification('Dummypla plagiarism plugin: Got you! "plagiarism" detected!' .
                                            $this->debug_details($linkarray), 'notifyproblem');
        } else {
            $output = $OUTPUT->notification('Dummypla plagiarism plugin: All right, your contents are original.' .
                                            $this->debug_details($linkarray), 'notifysuccess');
        }
        return $output;
    }

    public function print_disclosure($cmid) {
        global $OUTPUT;
        return $OUTPUT->notification('Dummypla plagiarism plugin is watching you!', 'notifyproblem');
    }

    protected function debug_details($linkarray) {
        global $CFG, $OUTPUT;
        $output = '';
        if ($CFG->debugdeveloper) {
            $output = html_writer::tag('pre', s(print_r($linkarray, true)));
        }
        return $output;
    }
}
