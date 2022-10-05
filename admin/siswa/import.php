<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function sekolahku_import_data_siswa() {
    ?>
    <div class="wrap">
        <h2>Import data siswa</h2>
        <div>
            <div class="format">
            Format CSV: <br>
            NIS, Nama Siswa/Siswi, Kelas, HP, Alamat, Ayah, Ibu, Wali, Jenjang Sosial, Seragam, Sarpras, UangGedung, SPP Lebih, pendaftaran, OrangTua Asuh, Alamat, HP, Donasi Bulanan, Subsidi silang, SPP
            </div>

            <div class="input-group mb-3">
                <input type="file" class="form-control" id="import-csv">
                <label class="input-group-text" for="import-csv">Upload</label>
            </div>
            <div id="result"></div>
        </div>
    </div>
    <?php
}