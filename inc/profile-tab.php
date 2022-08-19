<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// You could set the default privacy for custom tab and disable to change the tab privacy settings in admin menu.
/*
* There are values for 'default_privacy' atribute
* 0 - Anyone,
* 1 - Guests only,
* 2 - Members only,
* 3 - Only the owner
*/
// Filter
function um_dokumen_add_tab( $tabs ) {
	$tabs['dokumen'] = array(
		'name' 				=> 'Dokumen',
		'icon' 				=> 'um-icon-document',
		'default_privacy'   => 3,
        'custom'            => true 
	);
	return $tabs;
}
add_filter( 'um_profile_tabs', 'um_dokumen_add_tab', 1000 );

/**
 * Check an ability to view tab
 *
 * @param $tabs
 *
 * @return mixed
 */
function um_dokumen_add_tab_visibility( $tabs ) {
	if ( empty( $tabs['dokumen'] ) ) {
		return $tabs;
	}

	$user_id = um_profile_id();

	// if ( ! user_can( $user_id, '{here some capability which you need to check}' ) ) {
	// 	unset( $tabs['dokumen'] );
	// }

	return $tabs;
}
add_filter( 'um_user_profile_tabs', 'um_dokumen_add_tab_visibility', 2000, 1 );

// Action
function um_profile_content_dokumen_default( $args ) {
    $user_id = um_profile_id();
	$title = isset( $_POST['nama-file'] ) ? $_POST['nama-file'] : '';
	$attachment_id = '';
    $s = isset( $_GET['cari'] ) ? $_GET['cari'] : '';

	function upload_user_file( $file = array() ) {
		require_once( ABSPATH . 'wp-admin/includes/admin.php' );
		  $file_return = wp_handle_upload( $file, array('test_form' => false ) );
		  if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
			  return false;
		  } else {
			  $filename = $file_return['file'];
			  $attachment = array(
				  'post_mime_type' => $file_return['type'],
				  'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
				  'post_content' => '',
				  'post_status' => 'inherit',
				  'guid' => $file_return['url']
			  );
			  $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
			  require_once(ABSPATH . 'wp-admin/includes/image.php');
			  $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
			  wp_update_attachment_metadata( $attachment_id, $attachment_data );
			  if( 0 < intval( $attachment_id ) ) {
				return $attachment_id;
			  }
		  }
		  return false;
	}

	if( ! empty( $_FILES ) ) {
		
		// add to post type document
		$post_id = wp_insert_post( array(
			'post_title' => $title,
			'post_content' => '',
			'post_status' => 'private',
			'post_type' => 'document',
			'post_author' => $user_id,
			'post_parent' => 0
		) );

		foreach( $_FILES as $file ) {
			if( is_array( $file ) ) {
			$attachment_id = upload_user_file( $file );
			}
		}

		if( ! empty( $attachment_id ) ) {
			add_post_meta( $post_id, 'document_id', $attachment_id );
		}
        // print_r($attachment_id);
        $doc_name = basename ( get_attached_file( $attachment_id ) );
        echo '<div class="alert alert-success">File '.$doc_name.' berhasil diupload.</div>';
	}


	?>
<!-- Button trigger modal -->
<div class="text-end mb-3 mt-4 d-flex justify-content-between">
    <!-- add search form -->
    <form method="get" action="?">
    <div class="input-group">
        <div class="form-outline">
            <input type="search" id="cari" name="cari" class="form-control" value="<?php echo $s; ?>"/>
            <input type="hidden" name="profiletab" value="dokumen" />
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </div>
    </form>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"/>
            <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
        </svg>
        Upload PDF Dokumen
    </button>
</div>

<!-- loop post type document by this user -->
<?php
if($s) {
    echo '<div class="alert alert-info">Hasil pencarian untuk "'.$s.'". <a class="text-danger" href="?profiletab=dokumen">Tampilkan Semua</a></div>';
}
$args = array(
    'post_type' => 'document',
    'post_status' => 'private',
    'author' => $user_id,
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    's' => $s
);
$loop = new WP_Query( $args );
if( $loop->have_posts() ) {
    while( $loop->have_posts() ) {
        $loop->the_post();
        $doc_id = get_post_meta( get_the_ID(), 'document_id', true );
        $doc_url = wp_get_attachment_url( $doc_id );
        $doc_name = basename ( get_attached_file( $doc_id ) );
        ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo get_the_title(); ?></h5>
                <?php
                if( ! empty( $doc_id ) ) {
                    ?>
                    <a target="_blank" href="<?php echo $doc_url; ?>" class="btn btn-secondary" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                        Lihat Dokumen
                    </a>
                    <a href="<?php echo $doc_url; ?>" class="btn btn-primary" target="_blank" download>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
                            <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z"/>
                        </svg>
                        Download
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
}
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload PDF</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama-file" class="form-label">Nama Siswa</label>
                <input name="nama-file" class="form-control" type="text" id="nama-file" placeholder="Nama File" required>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input name="file-pdf" class="form-control" type="file" id="formFile" accept="application/pdf" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                    </svg>
                    Close
                </button>
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"/>
                        <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                    </svg>
                    Submit
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
    <?php
}
add_action( 'um_profile_content_dokumen_default', 'um_profile_content_dokumen_default' );