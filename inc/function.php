<?php

/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// get post meta by nis
function get_meta_by_nis($nis, $meta_key)
{
    global $wpdb;
    $results = $wpdb->get_results("select * from $wpdb->postmeta where meta_key = 'nis' AND meta_value = '$nis'", ARRAY_A);
    return get_post_meta($results[0]['post_id'], $meta_key, true);
}


// SHORTCODE STATUS
function status_check_form_shortcode()
{
    ob_start();
    $tracking_number = $_GET['nomor_registrasi'] ?? '';
?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form id="status-check-form" action="?" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="tracking-number" name="nomor_registrasi" placeholder="Masukan nomor regristrasi" value="<?php echo $tracking_number ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Cek Status</button>
                        </div>
                    </div>
                </form>
                <div id="status-result"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php
        $tracking_number = $_GET['nomor_registrasi'] ?? '';
        $my_post = get_page_by_title($tracking_number, OBJECT, 'form-ppdb');
        $post_id = $my_post->ID;
        $status = get_post_meta($post_id, 'status', true);
        $nama = get_post_meta($post_id, 'nama_lengkap_form', true);
        $alamat = get_post_meta($post_id, 'alamat_form', true);
        if ($status == "Pengajuan") {
            echo '<div class="alert alert-warning text-center mx-auto p-4" style="max-width: 500px;" role="alert">';
            echo "<h3 class='h5'>Status Pendaftaran: $status</h3><hr>Pendaftaran <b>$nama</b>, $alamat sedang direview. Periksa halaman ini secara berkala untuk mengetahui status terbaru.";
            echo '</div>';
        } elseif ($status == "Belum Membayar Registrasi") {
            echo '<div class="alert alert-primary text-center mx-auto p-4" style="max-width: 500px;" role="alert">';
            echo "<h3 class='h5'>Status Pendaftaran: $status</h3><hr>Pendaftaran <b>$nama</b>, $alamat telah diterima, namun pembayaran registrasi belum selesai. Silakan lakukan pembayaran untuk menyelesaikan pendaftaran Anda.";
            echo '</div>';
        } elseif ($status == "Teregristasi") {
            echo '<div class="alert alert-success text-center mx-auto p-4" style="max-width: 500px;" role="alert">';
            echo "<h3 class='h5'>Status Pendaftaran: $status</h3><hr>Pendaftaran <b>$nama</b>, $alamat telah berhasil dan Anda sekarang terdaftar.";
            echo '</div>';
        } elseif ($status == "Regristasi Gagal") {
            echo '<div class="alert alert-danger text-center mx-auto p-4" style="max-width: 500px;" role="alert">';
            echo "<h3 class='h5'>Status Pendaftaran: $status</h3><hr>Pendaftaran <b>$nama</b>, $alamat gagal atau ditolak. Mohon hubungi kami untuk informasi lebih lanjut.";
            echo '</div>';
        } elseif ($tracking_number) {
            echo '<div class="alert alert-danger mt-3 text-center mx-auto p-4" style="max-width: 500px;" role="alert">';
            echo "<h3 class='h5'>Data tidak ditemukan</h3><hr>Nomor pendaftaran <b>$tracking_number</b> tidak dapat ditemukan dalam sistem kami. Pastikan Anda telah memasukkan nomor pendaftaran dengan benar atau hubungi kami untuk bantuan.";
            echo '</div>';
        }
        ?>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('status_check_form', 'status_check_form_shortcode');

//regsiter page template
add_filter('template_include', 'register_page_template');
function register_page_template($template)
{

    if (is_singular()) {
        $page_template = get_post_meta(get_the_ID(), '_wp_page_template', true);
        if ('pdf-kepribadian' === $page_template) {
            $template = plugin_dir_path(__FILE__) . '../page-print.php';
        }
    }

    return $template;
}
add_filter("theme_page_templates", 'vdc_templates_page');
function vdc_templates_page($post_templates)
{
    $post_templates['pdf-kepribadian'] = __('PDF Kepribadian', 'wss-studio');
    return $post_templates;
}
