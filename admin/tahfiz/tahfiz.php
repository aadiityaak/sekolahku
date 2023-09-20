<?php

/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// Add the custom columns to the book post type:
add_filter('manage_tahfiz_posts_columns', 'set_custom_edit_tahfiz_columns');
function set_custom_edit_tahfiz_columns($columns)
{
    unset($columns['title']);
    unset($columns['author']);
    unset($columns['date']);
    $columns['nama'] = 'Nama';
    $columns['jenis_setoran'] = 'Jenis Setoran';
    $columns['nis'] = 'NIS';
    $columns['kelas'] = 'Kelas';
    $columns['tanggal'] = 'Tanggal';
    $columns['awal'] = 'Awal';
    $columns['akhir'] = 'Akhir';
    $columns['nilai'] = 'Nilai';

    return $columns;
}
add_filter('manage_edit-tahfiz_sortable_columns', 'my_sortable_tahfiz_column');
function my_sortable_tahfiz_column($columns)
{
    $columns['nama'] = 'nama';
    $columns['jenis_setoran'] = 'Jenis Setoran';
    $columns['nis'] = 'NIS';
    $columns['kelas'] = 'Kelas';
    $columns['tanggal'] = 'Tanggal';
    $columns['awal'] = 'Awal';
    $columns['akhir'] = 'Akhir';
    $columns['nilai'] = 'Nilai';
    //To make a column 'un-sortable' remove it from the array
    //unset($columns['date']);

    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action('manage_tahfiz_posts_custom_column', 'custom_tahfiz_column', 10, 2);
function custom_tahfiz_column($column, $post_id)
{
    switch ($column) {

        case 'nama':
            $siswa = get_post_meta($post_id, 'siswa', true);
            $nis = get_post_meta($post_id, 'nis', true);
            $nama = get_post_meta($siswa, 'nama_panggilan', true);
            echo '<a href="?post_type=tahfiz&nis=' . $nis . '">' . $nama . '</a>';
            break;
        case 'jenis_setoran':
            $jenis_setoran = get_post_meta($post_id, 'jenis_setoran', true);
            $jenis_setoran = ($jenis_setoran == 'Murojaah') ? 'Murojaah Hafalan Baru' : $jenis_setoran;
            echo $jenis_setoran;
            break;
        case 'nis':
            $nis = get_post_meta($post_id, 'nis', true);
            echo $nis;
            break;
        case 'kelas':
            $kelas = get_post_meta($post_id, 'kelas', true);
            echo '<a href="?post_type=tahfiz&kelas= ' . $kelas . '">' . $kelas . '</a>';
            // echo $kelas.' - '.$terms_string;
            break;
        case 'tanggal':
            $awal = get_post_meta($post_id, 'tanggal', true);
            echo $awal;
            break;
        case 'awal':
            $awal = get_post_meta($post_id, 'awal', true);
            $awal = explode('_', $awal);
            $nomor = isset($awal[0]) ? $awal[0] : '';
            $nama = isset($awal[1]) ? $awal[1] : '';
            $ayat = isset($awal[2]) ? $awal[2] : '';
            echo '<b>' . $nama . ' (' . $nomor . ')</b><br/> Ayat ' . $ayat . '<br/>';
            // echo nomor_halaman($nomor, $ayat);
            break;
        case 'akhir':

            $akhir = get_post_meta($post_id, 'akhir', true);
            $akhir = explode('_', $akhir);
            $nomor = isset($akhir[0]) ? $akhir[0] : '';
            $nama = isset($akhir[1]) ? $akhir[1] : '';
            $ayat = isset($akhir[2]) ? $akhir[2] : '';
            echo '<b>' . $nama . ' (' . $nomor . ')</b><br/> Ayat ' . $ayat . '<br/>';
            // echo nomor_halaman($nomor, $ayat);
            break;
        case 'nilai':
            $awal = get_post_meta($post_id, 'nilai', true);
            echo $awal;
            break;
    }
}

// add post type tahfiz
add_action('init', 'register_custom_post_type_tahfiz');
function register_custom_post_type_tahfiz()
{
    register_post_type(
        'tahfiz',
        array(
            'labels' => array(
                'name' => __('Tahfiz'),
                'singular_name' => __('Tahfiz'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add New Tahfiz'),
                'edit_item' => __('Edit Tahfiz'),
                'new_item' => __('New Tahfiz'),
                'view_item' => __('View Tahfiz'),
                'search_items' => __('Search Tahfiz'),
                'not_found' => __('No Tahfiz found'),
                'not_found_in_trash' => __('No Tahfiz found in Trash'),
                'parent_item_colon' => __('Parent Tahfiz'),
                'menu_name' => __('Tahfiz'),
            ),

            'public' => false,
            'show_ui' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'tahfiz'),
            'supports' => array('title'),
            'menu_icon' => SEKOLAHKU_URL . 'asset/img/man.png',
            'capability_type' => 'post',
            'show_in_rest' => false,
            'rest_base' => 'siswa',
        )
    );
}

add_action('admin_menu', 'wpdocs_register_my_custom_submenu_page');
function wpdocs_register_my_custom_submenu_page_tahfiz()
{
    add_submenu_page(
        'edit.php?post_type=tahfiz',
        'Import',
        'Import',
        'manage_options',
        'import-tahfiz',
        'sekolahku_import_data_tahfiz',
    );
}

/**
 * Adds a submenu page under a custom post type parent.
 */

add_action('admin_menu', 'books_register_ref_page');

function books_register_ref_page()
{
    add_submenu_page(
        'edit.php?post_type=tahfiz',
        __('Kelas', 'textdomain'),
        __('Kelas', 'textdomain'),
        'manage_options',
        'kelas',
        'kelas_page_callback'
    );
}

/**
 * Display callback for the submenu page.
 */
function kelas_page_callback()
{
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <div class="wrap">
        <h1><?php _e('Kelas', 'textdomain'); ?></h1>
        <div>
            <?php
            global $post;
            $kelas = get_unique_post_meta_values('rombel_saat_ini', 'siswa');
            $rombel_sat_ini = isset($_POST['kelas']) ? $_POST['kelas'] : '';
            ?>
            <form method='POST'>
                <div class="row mb-3">
                    <div class="col-10">
                        <select class="form-select w-100 form-select-lg" style="max-width:100% !important;padding: 4px 17px 4px 7px;border-radius: 5px;" name="kelas" aria-label="Default select example">
                            <?php
                            foreach ($kelas as $data) {
                                $selected = isset($_POST['kelas']) && $_POST['kelas'] == $data ? 'selected' : '';
                                echo '<option value="' . $data . '" ' . $selected . '>' . $data . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-secondary w-100">Cari</button>
                    </div>
                </div>
            </form>

            <div>
                <?php
                $args = array(
                    'post_type' => 'siswa',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'rombel_saat_ini',
                            'value' => $rombel_sat_ini,
                            'compare' => '=',
                        )
                    )
                );
                $query = new WP_Query($args);
                $i = 1;

                if ($query->have_posts()) {
                ?>
                    <div class="accordion" id="accordionExample">

                        <?php
                        while ($query->have_posts()) {
                            $query->the_post();
                            $j = $i++;
                        ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?php echo $j; ?>j">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $j; ?>" aria-expanded="true" aria-controls="collapse<?php echo $j; ?>">
                                        <?php echo get_the_title(); ?>, <?php echo get_post_meta($post->ID, 'nis', true); ?>, <?php echo get_post_meta($post->ID, 'rombel_saat_ini', true); ?>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $j; ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?php echo $j; ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php
                                        echo data_tahfis($post->ID);
                                        ?>
                                    </div>
                                </div>
                            </div>

                        <?php
                        } // end while
                        ?>
                    </div>
                <?php
                } // end if
                ?>
            </div>
        </div>
    </div>
    <?php
}


function get_unique_post_meta_values($key = 'trees', $type = 'post', $status = 'publish')
{
    global $wpdb;
    if (empty($key))
        return;
    $res = $wpdb->get_col($wpdb->prepare("
    SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
    LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
    WHERE pm.meta_key = '%s'
    AND p.post_status = '%s'
    AND p.post_type = '%s'
    ", $key, $status, $type));
    $res = array_filter($res);
    return $res;
}

function data_tahfis($siswa = '')
{
    //echo $siswa;
    ob_start();
    global $post;
    $args2 = array(
        'post_type' => 'tahfiz',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'siswa',
                'value' => $siswa,
                'compare' => '=',
            )
        )
    );
    $query_tahfis = new WP_Query($args2);
    //print_r ($query_tahfis);


    if ($query_tahfis->have_posts()) {
    ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Jenis Setoran</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Dari</th>
                    <th scope="col">Sampai</th>
                    <th scope="col">Nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nilai = $kesimpulan_terkecil = $kesimpulan_terbesar = [];
                $m = 1;
                while ($query_tahfis->have_posts()) {
                    $query_tahfis->the_post();
                    $awal       = get_post_meta($post->ID, 'awal', true);
                    $awal_nomor  = pecah_nama_surat($awal)[0] ?? $awal;
                    $awal_nama  = pecah_nama_surat($awal)[1] ?? $awal;
                    $awal_ayat  = pecah_nama_surat($awal)[2] ?? $awal;

                    $akhir      = get_post_meta($post->ID, 'akhir', true);
                    $akhir_nomor = pecah_nama_surat($akhir)[0] ?? $akhir;
                    $akhir_nama = pecah_nama_surat($akhir)[1] ?? $akhir;
                    $akhir_ayat = pecah_nama_surat($akhir)[2] ?? $akhir;
                ?>
                    <tr>
                        <th scope="row"><?php echo $m++; ?></th>
                        <td><?php echo get_post_meta($post->ID, 'jenis_setoran', true); ?></td>
                        <td><?php echo get_post_meta($post->ID, 'tanggal', true); ?></td>
                        <td>
                            <?php
                            $ayah = "$awal_nomor:$awal_ayat"; // Ayat yang ingin Anda ambil dan cache
                            $result = get_AyatData($ayah);

                            if (is_array($result)) {
                                // Data berhasil diambil, tampilkan hasil
                                echo $awal_nomor . ".<b>$awal_nama</b> Ayat $awal_ayat<br>";
                                echo "Halaman: <b>" . $result['page'] . "</b>";
                                echo " Juz: <b>" . $result['juz'] . "</b>";
                                $kesimpulan_terkecil[$awal_nomor][] = $awal_ayat;
                            } else {
                                // Terjadi kesalahan dalam mengambil data
                                echo "Terjadi kesalahan: " . $result;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $ayah = "$akhir_nomor:$akhir_ayat"; // Ayat yang ingin Anda ambil dan cache
                            $result = get_AyatData($ayah);

                            if (is_array($result)) {
                                // Data berhasil diambil, tampilkan hasil
                                echo $akhir_nomor . ".<b>$akhir_nama</b> Ayat $akhir_ayat<br>";
                                echo "Halaman: <b>" . $result['page'] . "</b>";
                                echo " Juz: <b>" . $result['juz'] . "</b>";
                                $kesimpulan_terbesar[$akhir_nomor][] = $akhir_ayat;
                            } else {
                                // Terjadi kesalahan dalam mengambil data
                                echo "Terjadi kesalahan: " . $result;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $nilai[] = get_post_meta($post->ID, 'nilai', true);
                            echo get_post_meta($post->ID, 'nilai', true);
                            ?>
                        </td>
                    </tr>

                <?php
                }

                ?>
                <tr class="bg-dark text-white">
                    <th scope="row="></th>
                    <td><b>Nilai rata - rata</b></td>
                    <td></td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    <?php
                        // Filter array untuk menghapus nilai kosong
                        $nilai = array_filter($nilai, function($value) {
                            return !empty($value);
                        });

                        // Menghitung rata-rata
                        $rata_rata = array_sum($nilai) / count($nilai);

                        // Hasil rata-rata
                        echo number_format($rata_rata);
                    ?></td>
                </tr>
            </tbody>
        </table>
    <?php
    } else {
        echo '<b>Setoran hafalan tidak ditemukan</b>';
    }


    return ob_get_clean();
}

function pecah_nama_surat($val)
{
    $count = strpos($val, '_');
    // echo $count;
    if (false !== $count) {
        return explode('_', $val);
    } else {
        return $val;
    }
}

//SHORTCODE FUNCTION CARI DATA FRONT END BERDASARKAN NIS
function fucn_page_nis()
{
    ob_start();
    global $post;
    ?>
    <div>
        <?php
        global $post;
        $nis = isset($_GET['nis']) ? $_GET['nis'] : '';
        ?>
        <form method='GET'>
            <div class="row mb-3">
                <div class="col-10">
                    <input class="form-control" value="<?php echo $nis ?>" name="nis" placeholder="Masukan NIS">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-secondary w-100">Cari</button>
                </div>
            </div>
        </form>

        <div>
            <?php
            $args = array(
                'post_type'              => array('siswa'),
                'posts_per_page'         => -1,
                'meta_query'             => array(
                    array(
                        'key'       => 'nis',
                        'value'     => $nis,
                    ),
                ),
            );

            // The Query
            $query = new WP_Query($args);

            // The Loop
            if ($query->have_posts() && $nis) {
                while ($query->have_posts()) {
                    $query->the_post();
                    // do something
            ?>
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
                        <div class="card w-100 mb-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Nama <b><?php echo get_the_title($post->ID); ?></b></li>
                                <li class="list-group-item">Rombel Saat Ini <b><?php echo get_post_meta($post->ID, 'rombel_saat_ini', true); ?></b></li>
                                <li class="list-group-item">Alamat Lengkap <b><?php echo get_post_meta($post->ID, 'alamat', true); ?></b></li>
                            </ul>
                        </div>
                        <?php
                        echo data_tahfis($post->ID);
                        ?>
                    </div>
            <?php
                }
            } else {
                // no posts found
            }

            // Restore original Post Data
            wp_reset_postdata();
            ?>
        </div>
        <?php

        return ob_get_clean();
    }

    add_shortcode('detail-siswa', 'fucn_page_nis');

    // Filter posts di halaman admin
    add_action('pre_get_posts', 'filter_tahfiz_by_nis');

    function filter_tahfiz_by_nis($query)
    {
        $nis = isset($_GET['nis']) ? $_GET['nis'] : '';
        $kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';
        // Memastikan bahwa filter hanya berlaku di halaman admin dan query post type 'tahfiz'
        if (is_admin() && $query->is_main_query() && $query->get('post_type') === 'tahfiz' && $nis) {
            // Menambahkan filter untuk post meta 'nis'
            $query->set('meta_query', array(
                array(
                    'key' => 'nis',
                    'value' => $nis,
                    'compare' => '='
                )
            ));
        }
        if (is_admin() && $query->is_main_query() && $query->get('post_type') === 'tahfiz' && $kelas) {
            // Menambahkan filter untuk post meta 'nis'
            $query->set('meta_query', array(
                array(
                    'key' => 'kelas',
                    'value' => $kelas,
                    'compare' => '='
                )
            ));
        }
    }

    // Menambahkan tombol di samping filter pada halaman admin post type 'tahfiz'
    function tambahkan_tombol_di_samping_filter_tahfiz()
    {
        global $typenow;

        // Pastikan tombol hanya ditampilkan pada halaman post type 'tahfiz'
        if ($typenow === 'tahfiz') {
        ?>
            <a href="?post_type=tahfiz" class="button">Reset</a>
    <?php
        }
    }
    add_action('restrict_manage_posts', 'tambahkan_tombol_di_samping_filter_tahfiz');

    // Fungsi untuk menangani permintaan download CSV
    function download_csv_tahfiz()
    {
        // Membuat query untuk mengambil data post type 'tahfiz'
        $args = array(
            'post_type' => 'tahfiz',
            'posts_per_page' => -1,
        );

        $query = new WP_Query($args);

        // Nama file yang akan di-generate
        $filename = 'data_tahfiz.csv';

        // Membuka file handle untuk menulis data
        $file_handle = fopen($filename, 'w');

        // Menulis header pada file CSV
        fputcsv($file_handle, array('Title', 'Content', 'Custom Field 1', 'Custom Field 2', /* tambahkan field tambahan jika diperlukan */));

        // Loop untuk menulis data post type 'tahfiz' pada file CSV
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                // Mendapatkan nilai dari custom field yang diinginkan
                $custom_field_1 = get_post_meta(get_the_ID(), 'nama_custom_field_1', true);
                $custom_field_2 = get_post_meta(get_the_ID(), 'nama_custom_field_2', true);

                // Menulis data post pada file CSV
                fputcsv($file_handle, array(get_the_title(), get_the_content(), $custom_field_1, $custom_field_2 /* tambahkan nilai custom field tambahan jika diperlukan */));
            }
        }

        // Menutup file handle
        fclose($file_handle);

        // Mengirim file ke browser untuk didownload
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        readfile($filename);

        // Menghapus file setelah didownload
        unlink($filename);

        // Hentikan eksekusi PHP agar tidak ada konten tambahan yang dikirimkan
        exit();
    }

    // Action hook untuk menangani permintaan download CSV
    add_action('admin_action_download_csv_tahfiz', 'download_csv_tahfiz');



// //Creat Jenjang Taxonomy
// function wpdocs_create_jenjang_tahfiz()
// {
//     register_taxonomy('jenjang', 'tahfiz', array(
//         'label'        => __('Jenjang', 'sekolahku'),
//         'rewrite'      => array('slug' => 'jenjang'),
//         'hierarchical' => true,
//         'show_admin_column' => true,
//     ));
// }
// add_action('init', 'wpdocs_create_jenjang_tax', 0);

// //Creating Filters With Custom Taxonomy
// add_action('restrict_manage_posts', 'filter_by_jenjang');
// function filter_by_jenjang()
// {
//     $screen = get_current_screen();
//     global $wp_query;
//     if ($screen->post_type == 'siswa') {
//         wp_dropdown_categories(array(
//             'show_option_all' => 'Semua Jenjang',
//             'taxonomy' => 'jenjang',
//             'name' => 'jenjang',
//             'orderby' => 'name',
//             'selected' => (isset($wp_query->query['jenjang']) ? $wp_query->query['jenjang'] : ''),
//             'hierarchical' => true,
//             'depth' => 3,
//             'show_count' => true,
//             'hide_empty' => false,
//             'value_field' => 'slug',
//         ));
//     }
// }