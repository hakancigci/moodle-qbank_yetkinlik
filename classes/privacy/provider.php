<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Question bank plugin features definition.
 *
 * @package    qbank_yetkinlik
 * @copyright  2026 Hakan Çiğci {@link https://hakancigci.com.tr}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace qbank_yetkinlik\privacy;

defined('MOODLE_INTERNAL') || die();

use core_privacy\local\metadata\collection;
use core_privacy\local\request\approved_contextlist;
use core_privacy\local\request\approved_userlist;
use core_privacy\local\request\contextlist;
use core_privacy\local\request\userlist;

/**
 * qbank_yetkinlik eklentisi için Gizlilik Sağlayıcısı.
 */
class provider implements
    \core_privacy\local\metadata\provider,
    \core_privacy\local\request\plugin\provider {

    /**
     * Eklenti tarafından saklanan verilerin tanımlanması.
     *
     * @param collection $items Veri koleksiyonu.
     * @return collection Dönüştürülmüş koleksiyon.
     */
    public static function get_metadata(collection $items): collection {
        // Eğer veritabanında kullanıcı tabanlı yetkinlik eşleşmeleri saklıyorsanız buraya ekleyin
        $items->add_database_table(
            'qbank_yetkinlik_table_name', // Gerçek tablo adınızı yazın
            [
                'userid' => 'privacy:metadata:userid',
                'competencyid' => 'privacy:metadata:competencyid',
                'timecreated' => 'privacy:metadata:timecreated'
            ],
            'privacy:metadata:description'
        );

        return $items;
    }

    /**
     * Belirli bir kullanıcıyla ilgili tüm bağlamları (contexts) getirir.
     *
     * @param int $userid Sorgulanan kullanıcı ID.
     * @return contextlist Kullanıcının verisinin bulunduğu bağlam listesi.
     */
    public static function get_contexts_for_userid(int $userid): contextlist {
        $contextlist = new contextlist();

        // Örnek: Kullanıcının kendi yetkinliklerini tanımladığı sistem veya kurs bağlamlarını ekleyin
        $sql = "SELECT c.id
                  FROM {context} c
                  JOIN {qbank_yetkinlik_table_name} t ON t.contextid = c.id
                 WHERE t.userid = :userid";
        
        $contextlist->add_from_sql($sql, ['userid' => $userid]);

        return $contextlist;
    }

    /**
     * Kullanıcı verilerini dışa aktarır.
     *
     * @param approved_contextlist $contextlist Onaylanmış bağlam listesi.
     */
    public static function export_user_data(approved_contextlist $contextlist) {
        // Veri dışa aktarma mantığı buraya gelir
    }

    /**
     * Bir bağlamdaki tüm kullanıcı verilerini siler.
     *
     * @param \core_privacy\local\request\context $context Silinecek bağlam.
     */
    public static function delete_data_for_all_users_in_context(\core_privacy\local\request\context $context) {
        // Silme mantığı
    }

    /**
     * Onaylanmış listedeki kullanıcı verilerini siler.
     *
     * @param approved_contextlist $contextlist Silinecek kullanıcı ve bağlam listesi.
     */
    public static function delete_data_for_user(approved_contextlist $contextlist) {
        // Belirli kullanıcı verilerini silme mantığı
    }
}
