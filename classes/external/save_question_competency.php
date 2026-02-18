<?php
/**
 * @package    qbank_yetkinlik
 * @copyright  2026
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace qbank_yetkinlik\external;

defined('MOODLE_INTERNAL') || die();

use stdClass;
use context_course;

/**
 * Soru yetkinliklerini kaydeden dış servis sınıfı.
 */
class save_question_competency extends \core_external\external_api {

    /**
     * Parametre tanımlamaları.
     */
    public static function execute_parameters() {
        // Namespace içindeki karışıklığı önlemek için tam yol kullanıyoruz
        return new \core_external\external_function_parameters([
            'questionid'   => new \core_external\external_value(PARAM_INT, 'Soru ID'),
            'competencyid' => new \core_external\external_value(PARAM_INT, 'Yetkinlik ID'),
            'courseid'     => new \core_external\external_value(PARAM_INT, 'Kurs ID'),
        ]);
    }

    /**
     * Yetkinlik kaydetme işlemini yürüten ana metod.
     */
    public static function execute($questionid, $competencyid, $courseid) {
        global $DB;

        // Parametre validasyonu
        $params = self::validate_parameters(self::execute_parameters(), [
            'questionid'   => $questionid,
            'competencyid' => $competencyid,
            'courseid'     => $courseid,
        ]);

        // Güvenlik ve Context kontrolü
        $context = context_course::instance($params['courseid']);
        self::validate_context($context);
        require_capability('moodle/course:manageactivities', $context);

        $table = 'local_yetkinlik_qmap';
        $record = $DB->get_record($table, [
            'questionid' => $params['questionid'],
            'courseid'   => $params['courseid']
        ]);

        if ($params['competencyid'] == 0) {
            if ($record) {
                $DB->delete_records($table, ['id' => $record->id]);
            }
        } else {
            if ($record) {
                $record->competencyid = $params['competencyid'];
                $DB->update_record($table, $record);
            } else {
                $newrecord = new stdClass();
                $newrecord->questionid   = $params['questionid'];
                $newrecord->competencyid = $params['competencyid'];
                $newrecord->courseid     = $params['courseid'];
                $newrecord->timecreated  = time();
                $DB->insert_record($table, $newrecord);
            }
        }

        return true;
    }

    /**
     * Dönüş değeri tanımlaması.
     */
    public static function execute_returns() {
        return new \core_external\external_value(PARAM_BOOL, 'Başarı durumu');
    }
}