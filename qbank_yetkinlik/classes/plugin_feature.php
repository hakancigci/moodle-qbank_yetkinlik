<?php
namespace qbank_yetkinlik;

defined('MOODLE_INTERNAL') || die();

use core_question\local\bank\view;

class plugin_feature extends \core_question\local\bank\plugin_features_base {

    public function get_question_columns(view $qbank): array {
        return [
            new \qbank_yetkinlik\column\competency_column($qbank)
        ];
    }
}
