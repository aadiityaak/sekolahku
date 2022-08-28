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

class My_Example_List_Table extends WP_List_Table {

    private $wpdb;

    var $example_data = array(
        array( 'ID' => 1,'siswatitle' => 'Quarter Share', 'author' => 'Nathan Lowell', 
                'isbn' => '978-0982514542' ),
        array( 'ID' => 2, 'siswatitle' => '7th Son: Descent','author' => 'J. C. Hutchins',
                'isbn' => '0312384378' ),
        array( 'ID' => 3, 'siswatitle' => 'Shadowmagic', 'author' => 'John Lenahan',
                'isbn' => '978-1905548927' ),
        array( 'ID' => 4, 'siswatitle' => 'The Crown Conspiracy', 'author' => 'Michael J. Sullivan',
                'isbn' => '978-0979621130' ),
        array( 'ID' => 5, 'siswatitle'     => 'Max Quick: The Pocket and the Pendant', 'author'    => 'Mark Jeffrey',
                'isbn' => '978-0061988929' ),
        array(' ID' => 6, 'siswatitle' => 'Jack Wakes Up: A Novel', 'author' => 'Seth Harwood',
                'isbn' => '978-0307454355' )
    );



    function __construct(){
        global $status, $page, $wpdb;
        $this->wpdb = $wpdb;

        parent::__construct( array(
            'singular'  => __( 'siswa', 'mylisttable' ),     //singular name of the listed records
            'plural'    => __( 'siswa', 'mylisttable' ),   //plural name of the listed records
            'ajax'      => true        //does this table support ajax?
        ) );
    }

    function column_default( $item, $column_name ) {
        switch( $column_name ) { 
            case 'id':
            case 'nis':
            case 'nama_siswa':
                return $item[ $column_name ];
            default:
                return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
        }
    }

    function get_columns(){
        $columns = array(
            'nis' => __( 'NIS', 'mylisttable' ),
            'nisn'    => __( 'NISN', 'mylisttable' ),
            'nama_lengkap'      => __( 'Nama Lengkap', 'mylisttable' )
        );
            return $columns;
    }
    function prepare_items() {
        $columns  = $this->get_columns();
        $hidden   = array();
        $sortable = array();

        print_r($this->wpdb);

        $table_siswa = $this->wpdb->prefix . 'siswa';
        $result = $this->wpdb->get_results ( "
            SELECT id,nisn,nis,nama_lengkap
            FROM  $table_siswa
        " );
        echo '<pre>';
        print_r($this->wpdb);
        echo '</pre>';

        $this->_column_headers = array( $columns, $hidden, $sortable );
        $this->items = $result->last_result;
    }

} //class


function siswa_menu_items(){
    add_menu_page( 'Siswa', 'Data Siswa', 'activate_plugins', 'data_siswa', 'siswa_render' );
}
add_action( 'admin_menu', 'siswa_menu_items' );

function siswa_render(){
    $myListTable = new My_Example_List_Table();
    echo '</pre><div class="wrap"><h2>Data Siswa</h2>'; 
        $myListTable->prepare_items(); 
        $myListTable->display(); 
    echo '</div>'; 
}