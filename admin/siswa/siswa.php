<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Table_Siswa extends WP_List_Table {

    private $wpdb;

    function __construct(){
        global $status, $page, $wpdb;
        $this->wpdb = $wpdb;

        parent::__construct( array(
            'singular'  => __( 'siswa', 'sekolahku' ),     //singular name of the listed records
            'plural'    => __( 'siswa', 'sekolahku' ),   //plural name of the listed records
            'ajax'      => true        //does this table support ajax?
        ) );
    }

    function column_default( $item, $column_name ) {
        switch( $column_name ) { 
            case 'id':
            case 'nis':
            case 'nisn':
            case 'nama_lengkap':
            case 'alamat':
            case 'ayah':
            case 'ibu':
            case 'wali':
                return $item->$column_name;
            default:
                return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
        }
    }

    function get_columns(){
        $columns = array(
            'nis' => __( 'NIS', 'sekolahku' ),
            'nisn'    => __( 'NISN', 'sekolahku' ),
            'nama_lengkap'      => __( 'Nama Lengkap', 'sekolahku' ),
            'alamat' => __( 'Alamat', 'sekolahku' ),
            'ayah' => __( 'Ayah', 'sekolahku' ),
            'ibu' => __( 'Ibu', 'sekolahku' ),
            'wali' => __( 'Wali', 'sekolahku' )
        );

        return $columns;
    }
    function prepare_items() {
        $columns  = $this->get_columns();
        $hidden   = array();
        $sortable = array();

        $table_siswa = $this->wpdb->prefix . 'siswa';
        $table_siswa_meta = $this->wpdb->prefix . 'siswa_meta';
        $result = $this->wpdb->get_results ( "
            SELECT DISTINCT 
                $table_siswa.id,
                $table_siswa.nisn,
                $table_siswa.nis,
                $table_siswa.nama_lengkap,
                (select meta_value from $table_siswa_meta where nis = $table_siswa.nis and meta_key = 'alamat' limit 1) as alamat,
                (select meta_value from $table_siswa_meta where nis = $table_siswa.nis and meta_key = 'ayah' limit 1) as ayah,
                (select meta_value from $table_siswa_meta where nis = $table_siswa.nis and meta_key = 'ibu' limit 1) as ibu,
                (select meta_value from $table_siswa_meta where nis = $table_siswa.nis and meta_key = 'wali' limit 1) as wali
                
            FROM  $table_siswa
            LEFT JOIN $table_siswa_meta ON $table_siswa.nis = $table_siswa_meta.nis

        " );
        // echo '<pre>';
        // print_r($this->wpdb);
        // echo '</pre>';

        $this->_column_headers = array( $columns, $hidden, $sortable );
        $this->items = $result;

    }

} //class


function siswa_menu_items(){
    add_menu_page( 'Siswa', 'Data Siswa', 'activate_plugins', 'data_siswa', 'siswa_render' );
}
add_action( 'admin_menu', 'siswa_menu_items' );

function siswa_render(){
    global $wpdb;
    $myListTable = new Table_Siswa();
    $table_siswa = $wpdb->prefix . 'siswa';
    $table_siswa_meta = $wpdb->prefix . 'siswa_meta';

    echo '<div class="wrap"><h2>Data Siswa</h2>'; 

    ?>
    <form action="?page=data_siswa" method="post" enctype="multipart/form-data">
        Import data
        <input type="file" name="siswacsv" id="siswacsv">
        <input type="hidden" name="datasiswa" id="datasiswa">
        <input type="submit" value="Upload Image" name="submit">
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
                            'meta_key' => 'ayah',
                            'meta_value' => $getData[3],
                        ));
                        $wpdb->insert($table_siswa_meta, array(
                            'nis' => $getData[0],
                            'meta_key' => 'ibu',
                            'meta_value' => $getData[4],
                        ));
                        $wpdb->insert($table_siswa_meta, array(
                            'nis' => $getData[0],
                            'meta_key' => 'wali',
                            'meta_value' => $getData[5],
                        ));
                        echo '<div class="notice notice-success is-dismissible">Import NIS '.$getData[0].' Berhasil!</div>';
                     } else {
                        echo '<div class="notice notice-error is-dismissible">Import NIS '.$getData[0].' Gagal!</div>';
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
        $myListTable->prepare_items(); 
        $myListTable->display(); 
    echo '</div>'; 
}