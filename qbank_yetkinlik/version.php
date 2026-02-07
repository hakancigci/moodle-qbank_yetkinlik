<?php
defined('MOODLE_INTERNAL') || die();

$plugin->component = 'qbank_yetkinlik';   // Eklenti adı
$plugin->version   = 2026020640;          // YYYYMMDDXX formatında versiyon
$plugin->requires  = 2025041400;          // Minimum Moodle 5.0 sürümü
$plugin->maturity  = MATURITY_STABLE;
$plugin->release   = '1.0';

// local_yetkinlik bağımlılığı
$plugin->dependencies = [
    'local_yetkinlik' => 2026020640
];