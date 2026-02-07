<?php
namespace qbank_yetkinlik\column;

use core_question\local\bank\column_base;

defined('MOODLE_INTERNAL') || die();

/**
 * Competency column for Question Bank
 *
 * @package    qbank_yetkinlik
 */
class competency_column extends column_base {

    public function init(): void {
        parent::init();
        // Autocomplete için JS yüklemiyoruz, klasik dropdown olacak.
    }

    public function get_name(): string {
        return 'yetkinlik';
    }

    public function get_title(): string {
        return get_string('competency', 'qbank_yetkinlik');
    }

    protected function display_content($question, $rowclasses): void {
        global $DB;

        $courseid   = $this->qbank->course->id;
        $questionid = $question->id ?? null;

        // Kursa atanmış yetkinlikleri çek.
        $competencies = $DB->get_records_sql_menu("
            SELECT c.id, c.shortname
              FROM {competency} c
              JOIN {competency_coursecomp} cc ON cc.competencyid = c.id
             WHERE cc.courseid = ?
             ORDER BY c.shortname
        ", [$courseid]);

        if (!$competencies) {
            echo '';
            return;
        }

        // Mevcut mapping'i bul.
        $current = $DB->get_field('local_yetkinlik_qmap', 'competencyid', [
            'courseid'   => $courseid,
            'questionid' => $questionid
        ]);

        // Klasik dropdown select.
        echo \html_writer::select(
            [0 => '—'] + $competencies,
            'competency_' . $questionid,
            $current,
            false, // size parametresi false → dropdown menü
            [
                'class'           => 'yetkinlik-select',
                'data-questionid' => $questionid,
                'data-courseid'   => $courseid
            ]
        );
    }

    public function get_extra_classes(): array {
        return ['pe-2'];
    }
}