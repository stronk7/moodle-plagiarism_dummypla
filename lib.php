<?php

require_once($CFG->dirroot.'/plagiarism/lib.php');

defined('MOODLE_INTERNAL') || die;

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
