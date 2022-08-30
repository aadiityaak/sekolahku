<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function sekolahku_import_data(){
    global $wpdb;
    $table_siswa = $wpdb->prefix . 'siswa';
    $table_siswa_meta = $wpdb->prefix . 'siswa_meta';

    ?>
    <form class="import-csv wp-upload-form" action="?page=data_siswa" method="post" enctype="multipart/form-data">
        <label class="file">
            <input type="file" id="file" name="siswacsv" aria-label="File browser example">
            <span class="file-pesan">Cari File..</span>
        </label>
        <input type="hidden" name="datasiswa" id="datasiswa">
        <br>
        <button type="submit" name="submit" class="button button-primary">
            Submit
        </button>
    </form>
    <?php
    if (isset($_POST['datasiswa']) &&$_FILES['siswacsv']['error'] == 0){
        // print_r($_FILES);
        // Allowed mime types
        $fileMimes = array(
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain'
        );
    
        // Validate whether selected file is a CSV file
        if (!empty($_FILES['siswacsv']['name']) && in_array($_FILES['siswacsv']['type'], $fileMimes)){
    
                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['siswacsv']['tmp_name'], 'r');
    
                // Skip the first line
                $file = fgetcsv($csvFile);
                // print_r($file);

    
                // Parse data from CSV file line by line
                // Parse data from CSV file line by line
                // $importsiswa =[];
                while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {
                    // $importsiswa[] = $getData;
                    
                    $result_check = $wpdb->insert($table_siswa, array(
                        'nis' => $getData[0],
                        'nisn' => $getData[1],
                        'nama_lengkap' => $getData[2], // ... and so on
                    ));
                    if($result_check){
                        $wpdb->insert($table_siswa_meta, array(
                            'nis' => $getData[0],
                            'meta_key' => 'alamat',
                            'meta_value' => $getData[3],
                        ));
                        $wpdb->insert($table_siswa_meta, array(
                            'nis' => $getData[0],
                            'meta_key' => 'ayah',
                            'meta_value' => $getData[4],
                        ));
                        $wpdb->insert($table_siswa_meta, array(
                            'nis' => $getData[0],
                            'meta_key' => 'ibu',
                            'meta_value' => $getData[5],
                        ));
                        $wpdb->insert($table_siswa_meta, array(
                            'nis' => $getData[0],
                            'meta_key' => 'wali',
                            'meta_value' => $getData[6],
                        ));
                        $pesan = '<div class="notice notice-success is-dismissible"><p>Import Berhasil!</p></div>';
                     } else {
                        $pesan = '<div class="notice notice-error is-dismissible"><p>Import Gagal!</p></div>';
                     }
                }
                // Close opened CSV file
                fclose($csvFile);
                echo $pesan;
                // echo '<pre>';
                // print_r($importsiswa);
                // echo '</pre>';
                
        } else {
            echo "Please select valid file";
        }
    }
}