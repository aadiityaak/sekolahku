<?php

/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// add post type keuangan
add_action( 'init', 'register_custom_post_type_karakter' );
function register_custom_post_type_karakter() {
    register_post_type( 'karakter',
        array(
            'labels' => array(
                'name' => __( 'Karakter' ),
                'singular_name' => __( 'Karakter' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Data Karakter' ),
                'edit_item' => __( 'Edit Data Karakter' ),
                'new_item' => __( 'New Data Karakter' ),
                'view_item' => __( 'View Data Karakter' ),
                'search_items' => __( 'Search Data Karakter' ),
                'not_found' => __( 'No Data Karakter found' ),
                'not_found_in_trash' => __( 'No Data Karakter found in Trash' ),
                'parent_item_colon' => __( 'Parent Data Karakter' ),
                'menu_name' => __( 'Karakter' ),
            ),

            'public' => false,
            'show_ui' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'data-karakter'),
            'supports' => array( 'title'),
            'menu_icon' => SEKOLAHKU_URL .'asset/img/pray.png',
            'capability_type' => 'post',
            'show_in_rest' => false,
            'rest_base' => 'data_karakter',
        )
    );
}

add_action('admin_menu', 'sekolahku_data_karakter_submenu_page');
function sekolahku_data_karakter_submenu_page() {
    add_submenu_page( 
        'edit.php?post_type=data-karakter',
        'Import',
        'Import',
        'manage_options',
        'import-data-karakter',
        'sekolahku_import_data_karakter',
    );
}

// Add the custom columns to the form-ppdb post type:
add_filter( 'manage_karakter_posts_columns', 'set_custom_karakter_ppdb_columns' );
function set_custom_karakter_ppdb_columns($columns) {
    unset( $columns['author'] );
    unset( $columns['date'] );
    $columns['siswa'] = __( 'Nama Lengkap', 'sekolahku' );
    $columns['nis'] = __( 'NIS', 'sekolahku' );
    $columns['kelas'] = __( 'Kelas', 'sekolahku' );
    $columns['bulan'] = __( 'Bulan', 'sekolahku' );

    return $columns;
}

// Add the data to the custom columns for the form-ppdb post type:
add_action( 'manage_karakter_posts_custom_column' , 'custom_karakter_ppdb_column', 10, 2 );
function custom_karakter_ppdb_column( $column, $post_id ) {
    switch ( $column ) {
        case 'siswa' :
            $nama = get_post_meta( $post_id , 'siswa' , true);
            $nama = get_the_title($nama);
            echo $nama;
            break;
        case 'nis' :
            $nis = get_post_meta( $post_id , 'nis' , true);
            echo $nis;
            break;
        case 'kelas' :
            $kelas = get_post_meta( $post_id , 'kelas' , true);
            echo $kelas . '<br>';
            break;
        case 'bulan' :
            $bulan_value = get_post_meta($post->ID, 'bulan', true); 
            $tanggal = date_create($bulan_value); $bulan_tampilan = date_format($tanggal, 'F Y'); 
            echo $bulan_tampilan;
            break;
    }
}



// SHORTCODE KARAKTER
function create_func_post_type_karakter() {
    ob_start();
    global $post;
    $nis = $_GET['nis'] ?? '';
    // the query.
    $the_query = new WP_Query([
        'meta_query' => array(
            array(
                'key'     => 'nis',
                'value'   => $nis,
                'compare' => '=',
            ),
        ),
        'post_type' => 'karakter'
    ]);
    ?>
    <div class="container">
        <div class="row formulir-input">
            <div class="col-md-6 offset-md-3">
                <form id="status-check-form" action="" method="get" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan nomor induk siswa" value="<?php echo $nis; ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Cek Status</button>
                        </div>
                    </div>
                </form>
                <div id="status-result"></div>
            </div>
        </div>
    </div>

    <?php if ($the_query->have_posts() && $nis) : ?>
        <!-- the loop -->
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <div class="container text-dark">
                <div class="mb-3">
                    <a class="btn btn-primary" id="printButton">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                        </svg>
                        Cetak
                    </a>
                </div>
                <div id="contentToPrint" class="print-me">
                <style>
                    .table td{
                        font-size: 11px;
                        border-top: 0 !important;
                        padding: 5px;
                    }
                </style>
                    <div class="card w-100 mb-4 mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Nama 
                            <b>
                            <?php 
                            $nama = get_post_meta( $post->ID , 'siswa' , true);
                            $nama = get_the_title($nama);
                            echo $nama; 
                            ?>
                            </b>
                            </li>
                            <li class="list-group-item">Rombel Saat Ini <b><?php echo get_post_meta($post->ID, 'kelas', true); ?></b></li>
                            <li class="list-group-item">Bulan <b><?php $bulan_value = get_post_meta($post->ID, 'bulan', true); $tanggal = date_create($bulan_value); $bulan_tampilan = date_format($tanggal, 'F Y'); echo $bulan_tampilan;?></b></li>
                        </ul>
                    </div>
                        <div class="mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Kegiatan</th>
                                <th scope="col">Nilai</th>
                                <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $datas = [];
                                $datas['Ibadah'] = [
                                    'sholat_fardu' => 'Sholat Fardu',
                                    'sholat_rawatib' => 'Sholat Rowatib', 
                                    'sholat_lail_witir' => 'Sholat Lail/Witir', 
                                    'sholat_dhuha' => 'Sholat Dhuha', 
                                    'sholat_syuruq' => 'Sholat Syuruq'
                                ];

                                $isians = [];
                                $isians['Kebersihan dan Kerapian'] = [
                                    'piket' => 'Piket',
                                    'merawat_pakaian' => 'Merawat Pakaian', 
                                    'ranjang_dan_lemari' => 'Ranjang dan Lemari', 
                                    'kerapian_pakaian' => 'Kerapian Pakaian'
                                ];

                                $diclipines = [];
                                $diclipines['Kedisiplinan'] = [
                                    'kehadiran_disekolah' => 'Kehadiran Disekolah',
                                    'kehadiran_dalam_taklim' => 'Kehadiran dalam Taklim', 
                                    'kehadiran_dalam_ekstrakulikuler' => 'Kehadiran dalam Ekstrakulikuler', 
                                ];

                                $adabs = [];
                                $adabs['Adab dan Akhlak'] = [
                                    'ketika_di_masjid' => 'Ketika di Masjid',
                                    'makan_dan_minum' => 'Makan dan Minum', 
                                    'ketika_belajar' => 'Ketika Belajar', 
                                    'berinteraksi_dengan_ustadz' => 'Berinteraksi dengan Ustadz',
                                    'berinteraksi_dengan_seksama' => 'Berinteraksi dengan Seksama'
                                ];

                                $allData = array_merge($datas, $isians, $diclipines, $adabs);

                                foreach ($allData as $judul => $data) {
                                    echo '<tr>';
                                    echo '<td colspan="3"><b>' . $judul . '</b></td>';
                                    echo '</tr>';
                                    $rata_rata = [];
                                    foreach ($data as $key => $value) {
                                        $nilai = get_post_meta($post->ID, $key, true);
                                        $predikat = predikat($nilai);
                                        echo '<tr>';
                                        echo '<td class="ps-3">' . $value . '</td>';
                                        echo '<td>' . $nilai . '</td>';
                                        echo '<td>' . $predikat . '</td>';
                                        echo '</tr>';
                                        $rata_rata[] = $nilai;
                                    }
                                }
                                        $rata_rata_nilai = array_sum($rata_rata)/count($rata_rata);
                                        $rata_rata_predikat = predikat($rata_rata_nilai);
                                        echo '<tr class="bg-light">';
                                        echo '<td class="ps-3"><b>Rata - Rata</b></td>';
                                        echo '<td><b>' . $rata_rata_nilai . '</b></td>';
                                        echo '<td><b>' . $rata_rata_predikat . '</b></td>';
                                        echo '</tr>';
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        <b class="p-1">Catatan :</b>
                        <div class="p-1">
                            <?php echo get_post_meta($post->ID, 'catatan', true); ?>
                        </div>
                    </div>
                    <div class="text-end" style="border-bottom: 1px dotted #cccccc; width: 200px; margin: 0 0 0 auto; text-align: center !important; margin-top: 30px !important;">
                        <span>Cawas, <?php echo date('d F Y'); ?></span>
                        <br>
                        <span>Kepala Kesantrian</span>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
                
            </div>
        <?php endwhile; ?>
        <!-- end of the loop -->

        <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <center>
            Maaf, tidak ditemukan data dengan ID Pendaftaran tersebut.
        </center>
    <?php endif;

    return ob_get_clean();
}
add_shortcode('check_karakter', 'create_func_post_type_karakter');

function predikat($nilai=100){
    if ($nilai < 50) {
        return "Sangat Kurang";
    } elseif ($nilai > 50 && $nilai < 61) {
        return "Kurang";
    } elseif ($nilai > 60 && $nilai < 71) {
        return "Cukup";
    } elseif ($nilai > 70 && $nilai < 81) {
        return "Cukup Baik";
    } elseif ($nilai > 80 && $nilai < 91) {
        return "Baik";
    } else {
        return "Sangat Baik";
    }
}

