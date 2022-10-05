<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'wp_ajax_import_siswa', 'import_siswa' );
function import_siswa() {
	// print_r($_POST[]);
    global $post;
    $data = isset($_POST['data']) ? $_POST['data'] : [];
    $index = isset($_POST['index']) ? $_POST['index'] + 1 : [];
    
    $nis = isset($data[0]) ? $data[0]: '';
    $nisn = isset($data[1]) ? $data[1]: '';
    $nama_lengkap = isset($data[2]) ? $data[2]: '';
    $kelas = isset($data[3]) ? $data[3]: '';
    $hp = isset($data[4]) ? $data[4]: '';
    $alamat = isset($data[5]) ? $data[5]: '';
    $ayah = isset($data[6]) ? $data[6]: '';
    $ibu = isset($data[7]) ? $data[7]: '';
    $wali = isset($data[8]) ? $data[8]: '';
    $jenjang_sosial = isset($data[9]) ? $data[9]: '';
    $tagihan_seragam = isset($data[10]) ? $data[10]: '';
    $tagihan_sarpras = isset($data[11]) ? $data[11]: '';
    $tagihan_gedung = isset($data[12]) ? $data[12]: '';
    $spp_lebih = isset($data[13]) ? $data[13]: '';
    $tagihan_pendaftaran = isset($data[14]) ? $data[14]: '';
    $orangtua_asuh = isset($data[15]) ? $data[15]: '';
    $alamat_orangtua_asuh = isset($data[16]) ? $data[16]: '';
    $hp_orangtua_asuh = isset($data[17]) ? $data[17]: '';
    $donasi_perbulan = isset($data[18]) ? $data[18]: '';
    $subsidi_silang = isset($data[19]) ? $data[19]: '';
    $tagihan_spp = isset($data[20]) ? $data[20]: '';
    
    $my_query = new WP_Query( 'post_type=siswa&posts_per_page=-1&meta_key=nis&meta_value='.$nis );

    if($my_query->post_count > 0){
        $response = [
            'nis' => $nis,
            'status' => 'NIS sudah ada!',
            'index' => $index
        ];
    } else {
        // Gather post data.
        $new_siswa = [
            'post_title'   => $nama_lengkap,
            'post_status'  => 'publish',
            'post_type' => 'siswa',
            'meta_input'   => [
                'nis' => $nis,
                'nisn' => $nisn,
                'kelas' => $kelas,
                'hp' => $hp,
                'alamat' => $alamat,
                'ayah' => $ayah,
                'ibu' => $ibu,
                'wali' => $wali,
                'jenjang_sosial' => $jenjang_sosial,
                'tagihan_seragam' => $tagihan_seragam,
                'tagihan_sarpras' => $tagihan_sarpras,
                'tagihan_gedung' => $tagihan_gedung,
                'spp_lebih' => $spp_lebih,
                'tagihan_pendaftaran' => $tagihan_pendaftaran,
                'orangtua_asuh' => $orangtua_asuh,
                'alamat_orangtua_asuh' => $alamat_orangtua_asuh,
                'hp_orangtua_asuh' => $hp_orangtua_asuh,
                'donasi_perbulan' => $donasi_perbulan,
                'subsidi_silang' => $subsidi_silang,
                'tagihan_spp' => $tagihan_spp
            ],
        ];
        // Insert the post into the database.
        wp_insert_post( $new_siswa );
        $response = [
            'nis' => $nis,
            'status' => 'sukses',
            'index' => $index
        ];
    }
    wp_send_json($response);
	wp_die(); // this is required to terminate immediately and return a proper response
}

add_action( 'wp_ajax_import_spp', 'import_spp' );
function import_spp() {
	// print_r($_POST[]);
    global $post;
    $data = isset($_POST['data']) ? $_POST['data'] : [];
    
    $nis = isset($data[0]) ? $data[0]: '';
    $bulan = isset($data[1]) ? $data[1]: '';
    $nominal = isset($data[2]) ? $data[2]: '';
    $tanggal_dibayar = isset($data[3]) ? $data[3]: '';
    $status = isset($data[4]) ? $data[4]: '';
    
    $my_query = new WP_Query( 'post_type=siswa&posts_per_page=-1' );
    $sudahada =[];
    if ( $my_query->have_posts() ) {
        while ( $my_query->have_posts() ) {
            $my_query->the_post();
            $sudahada[] = get_post_meta($post->ID, 'nis', true);
        }
    }
    if(in_array($nis, $sudahada)){
        // Gather post data.
        $new_spp = [
            'post_title'   => $nis.'-'.$bulan,
            'post_status'  => 'publish',
            'post_type' => 'spp',
            'meta_input'   => [
                'nis' => $nis,
                'bulan' => $bulan,
                'nominal' => $nominal,
                'tanggal_dibayar' => $tanggal_dibayar,
                'status' => $status,
            ],
        ];
        // Insert the post into the database.
        wp_insert_post( $new_spp );
        $response = [
            'nis' => $nis,
            'status' => 'sukses'
        ];
    } else {
        $response = [
            'nis' => $nis,
            'status' => 'Database tidak ditemukan!'
        ];
    }
    wp_send_json($response);
	wp_die(); // this is required to terminate immediately and return a proper response
}