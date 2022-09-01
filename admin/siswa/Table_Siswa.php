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
    private $siswametas;

    function __construct(){
        global $status, $page, $wpdb, $siswametas;
        $this->wpdb = $wpdb;
        $this->siswametas = $siswametas;

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
                return $item->$column_name;
            case 'nisn':
            case 'nama_lengkap':
            case 'alamat':
            case 'ayah':
            case 'ibu':
            case 'wali':
            case 'kelas':
            case 'hp':
            case 'jenjang_sosial':
            case 'saudara_kandung':
            case 'orangtua_asuh':
            case 'alamat_orangtua_asuh':
            case 'hp_orangtua_asuh':
                return '<input class="no-border data-change" data-nis="'.$item->nis.'" data-key="'.$column_name.'" value="'.$item->$column_name.'" />';
            default:
                return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
        }
    }

    /**
     * Define our bulk actions
     * 
     * @since 1.2
     * @returns array() $actions Bulk actions
     */
    function get_bulk_actions() {
        $actions = array(
            'delete' => __( 'Delete' , 'visual-form-builder')
        );
        return $actions;
    }

    /**
     * Process our bulk actions
     * 
     * @since 1.2
     */
    function process_bulk_action() {     
        // print_r($_POST);   
        // echo '<br>--</br>';
        // print_r($_REQUEST);

        if ( isset($_POST['nis']) && 'delete' === $this->current_action() ) {
            $table_siswa = $this->wpdb->prefix . 'siswa';
            $table_siswa_meta = $this->wpdb->prefix . 'siswa_meta';
            $ids = implode( ',', $_POST['nis'] );
            $ids_view = implode( ', ', $_POST['nis'] );

            $this->wpdb->query( "DELETE FROM $table_siswa WHERE nis IN($ids)" );
            $this->wpdb->query( "DELETE FROM $table_siswa_meta WHERE nis IN($ids)" );
            echo '<div class="notice notice-error is-dismissible"><p>Data dengan NIS <b>'.$ids_view.'</b> Berhasil Dihapus!</p></div>';
            
        }
    }

    // Displaying checkboxes!
    function column_cb($item) {
        // print_r($item);
        return sprintf('<input type="checkbox" name="nis[]" value="%s"/>',$item->nis );
    }
    
    function get_columns(){
        
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'nis' => __( 'NIS', 'sekolahku' ),
            'nisn'    => __( 'NISN', 'sekolahku' ),
            'nama_lengkap'      => __( 'Nama Lengkap', 'sekolahku' ),
            'hp'      => __( 'HP', 'sekolahku' ),
            'alamat' => 'Alamat'
        );
        // return array_merge($column,$this->siswametas);
        return $columns;
    }
    function prepare_items() {
        $columns  = $this->get_columns();
        $hidden   = array();
        $sortable = array();

        $this->process_bulk_action();

        $table_siswa = $this->wpdb->prefix . 'siswa';
        $table_siswa_meta = $this->wpdb->prefix . 'siswa_meta';
        $i= 1;
        $setkey = '';
        foreach($this->siswametas as $key => $val) {
            $setkey .= ($i++ == 1) ? '' : ',';
            $setkey .= "(select meta_value from $table_siswa_meta where nis = $table_siswa.nis and meta_key = '$key' limit 1) as $key";
        }
        $result = $this->wpdb->get_results ( "
            SELECT DISTINCT 
                $table_siswa.id,
                $table_siswa.nisn,
                $table_siswa.nis,
                $table_siswa.nama_lengkap,
                $setkey
            FROM  $table_siswa
            LEFT JOIN $table_siswa_meta ON $table_siswa.nis = $table_siswa_meta.nis
        " );

        $this->_column_headers = array( $columns, $hidden, $sortable );
        $this->items = $result;

    }

} //class