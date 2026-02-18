<?php
defined('MOODLE_INTERNAL') || die();

$functions = [
    'qbank_yetkinlik_save_question_competency' => [
        'classname'   => 'qbank_yetkinlik\external\save_question_competency',
        'methodname'  => 'execute',
        'description' => 'Soru yetkinliğini kaydeder.',
        'type'        => 'write',
        'ajax'        => true,
    ],
];