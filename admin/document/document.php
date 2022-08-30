<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// add post meta document id
add_action( 'add_meta_boxes', 'add_meta_box_document_id' );
function add_meta_box_document_id() {
    add_meta_box(
        'document_id',
        __( 'ID Dokumen', 'textdomain' ),
        'document_id_callback',
        'document',
        'normal',
        'high'
    );
}
function document_id_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'document_id_nonce' );
    $document_id = get_post_meta( $post->ID, 'document_id', true );
    ?>
    <p>
        <label for="document_id"><?php _e( 'ID Dokumen', 'textdomain' ); ?></label>
        <input type="text" name="document_id" id="document_id" value="<?php echo $document_id; ?>">
    </p>
    <?php
}

// Add the custom columns to the book post type:
add_filter( 'manage_document_posts_columns', 'set_custom_edit_document_columns' );
function set_custom_edit_document_columns($columns) {
    unset( $columns['author'] );
    unset( $columns['date'] );
    $columns['document_id'] = __( 'Document', 'your_text_domain' );
    $columns['tanggal'] = __( 'Tanggal Upload', 'your_text_domain' );
    $columns['guru'] = __( 'Guru', 'your_text_domain' );

    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_document_posts_custom_column' , 'custom_document_column', 10, 2 );
function custom_document_column( $column, $post_id ) {
    switch ( $column ) {

        case 'document_id' :
            $id = get_post_meta( $post_id , 'document_id' , true);
            $url_by_id = get_attached_file($id);
            $nama_file = basename($url_by_id);
            // print_r($attachment);
            if ( $id ){
                echo '<a href="'.wp_get_attachment_url($url_by_id).'">'.$nama_file.'</a>';
            } else {
                echo 'Document tidak valid.';
            }
            break;

        case 'tanggal' :
            $date = get_the_date('d F Y');
            if ( $date ){
                echo $date;
            } else {
                echo '-';
            }
            break;
        case 'guru' :
            $author = get_the_author();
            if ( $author ){
                echo $author;
            } else {
                echo '-';
            }
            break;

    }
}