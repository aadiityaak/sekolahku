<?php

/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('wp_ajax_import_siswa', 'import_siswa');
function import_siswa()
{
    global $post;
    $data = isset($_POST['data']) ? $_POST['data'] : [];
    $nis = isset($_POST['data']['nis']) ? $_POST['data']['nis'] : '';
    $index = isset($_POST['index']) ? $_POST['index'] + 1 : '';
    $jenjang = isset($_POST['data']['jenjang']) ? $_POST['data']['jenjang'] : '';

    $response = [
        'nis' => $nis,
        'status' => 'skip',
        'index' => $index,
        'data' => $data
    ];

    if ($data['nama_siswa'] == '') {
        $response['status'] = 'Skip, Nama Kosong.';
    } else {
        $data_meta = $data;
        unset($data_meta['nama_siswa']);
        unset($data_meta['jenjang']);
        $my_query = new WP_Query('post_type=siswa&posts_per_page=-1&meta_key=nis&meta_value=' . $data['nis']);
        if ($my_query->post_count > 0) {
            if ($my_query->have_posts()) {
                while ($my_query->have_posts()) {
                    $my_query->the_post();

                    $post_update = array(
                        'ID'         => $post->ID,
                        'meta_input'   => $data_meta,
                    );

                    wp_update_post($post_update);
                    set_term($post->ID, $jenjang, 'jenjang');
                    $response['status'] = 'Update data berhasil.';
                } // end while
            } // end if
            wp_reset_postdata();
        } else {
            $new_siswa = [
                'post_title'   => $data['nama_siswa'],
                'post_status'  => 'publish',
                'post_type' => 'siswa',
                'meta_input'   => $data_meta,
            ];
            // Insert the post into the database.
            $id_siswa = wp_insert_post($new_siswa);
            set_term($id_siswa, $jenjang, 'jenjang');
            $response['status'] = 'Import data berhasil.';
        }
    }

    wp_send_json($response);
    wp_die();
}

function set_term($pid, $cat_name, $taxonomy) {
    $append = true ;// true means it will add the cateogry beside already set categories. false will overwrite

    //get the category to check if exists
    $cat  = get_term_by('name', $cat_name , $taxonomy);

    //check existence
    if($cat == false){

        //cateogry not exist create it 
        $cat = wp_insert_term($cat_name, $taxonomy);

        //category id of inserted cat
        $cat_id = $cat['term_id'] ;

    }else{

        //category already exists let's get it's id
        $cat_id = $cat->term_id ;
    }

    //setting post category 
    $res=wp_set_post_terms($pid,array($cat_id),$taxonomy ,$append);
}

add_action('wp_ajax_import_spp', 'import_spp');
function import_spp()
{
    // print_r($_POST[]);
    global $post;
    $data = isset($_POST['data']) ? $_POST['data'] : [];

    $nis = isset($data[0]) ? $data[0] : '';
    $bulan = isset($data[1]) ? $data[1] : '';
    $nominal = isset($data[2]) ? $data[2] : '';
    $tanggal_dibayar = isset($data[3]) ? $data[3] : '';
    $status = isset($data[4]) ? $data[4] : '';

    $my_query = new WP_Query('post_type=siswa&posts_per_page=-1');
    $sudahada = [];
    if ($my_query->have_posts()) {
        while ($my_query->have_posts()) {
            $my_query->the_post();
            $sudahada[] = get_post_meta($post->ID, 'nis', true);
        }
    }
    if (in_array($nis, $sudahada)) {
        // Gather post data.
        $new_spp = [
            'post_title'   => $nis . '-' . $bulan,
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
        wp_insert_post($new_spp);
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
