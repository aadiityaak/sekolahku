<?php

/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Register a custom menu page.
 */
function sekolahku_dasboard()
{
    add_menu_page(
        __('Dashboard Sekolah', 'textdomain'),
        'Dashboard',
        'manage_options',
        'dashboard-sekolah',
        'sekolahku_view_dashboard',
        SEKOLAHKU_URL . 'asset/img/school.png',
        6
    );
}
add_action('admin_menu', 'sekolahku_dasboard');

function sekolahku_view_dashboard()
{
    $pondok_args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'post_status'      => 'publish',
        'post_type'        => 'siswa',
        'tax_query' => array(
            array(
                'taxonomy' => 'jenjang',
                'field'    => 'slug',
                'terms'    => 'pondok',
            ),
        ),
    );
    $smp_args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'post_status'      => 'publish',
        'post_type'        => 'siswa',
        'tax_query' => array(
            array(
                'taxonomy' => 'jenjang',
                'field'    => 'slug',
                'terms'    => 'smp',
            ),
        ),
    );
    $sd_args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'post_status'      => 'publish',
        'post_type'        => 'siswa',
        'tax_query' => array(
            array(
                'taxonomy' => 'jenjang',
                'field'    => 'slug',
                'terms'    => 'sd',
            ),
        ),
    );
    $tk_args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'post_status'      => 'publish',
        'post_type'        => 'siswa',
        'tax_query' => array(
            array(
                'taxonomy' => 'jenjang',
                'field'    => 'slug',
                'terms'    => 'tk',
            ),
        ),
    );

    $get_post_pondok = new WP_Query($pondok_args);
    $get_post_smp = new WP_Query($smp_args);
    $get_post_sd = new WP_Query($sd_args);
    $get_post_tk = new WP_Query($tk_args);
    // print_r($get_post_sd);
?>
    <div class="container py-3">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 shadow">
                    <div class="p-2">
                        <h5 class="card-title">TKB</h5>
                        <p class="card-text"><?php echo $get_post_tk->post_count; ?> Siswa</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow">
                    <div class="p-2">
                        <h5 class="card-title">SD</h5>
                        <p class="card-text"><?php echo $get_post_sd->post_count; ?> Siswa</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow">
                    <div class="p-2">
                        <h5 class="card-title">SMP</h5>
                        <p class="card-text"><?php echo $get_post_smp->post_count; ?> Siswa</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow">
                    <div class="p-2">
                        <h5 class="card-title">PONDOK</h5>
                        <p class="card-text"><?php echo $get_post_pondok->post_count; ?> Santri</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <canvas id="spp-sd" width="835" height="370"></canvas>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow">
                    <div class="p-2">
                        <h5 class="card-title">GURU</h5>
                        <p class="card-text">76</p>
                    </div>
                </div>
                <div class="card border-0 shadow">
                    <div class="p-2">
                        <h5 class="card-title">KARYAWAN</h5>
                        <p class="card-text">76</p>
                    </div>
                </div>
                <div class="card border-0 shadow">
                    <div class="p-2">
                        <h5 class="card-title">BUKU</h5>
                        <p class="card-text">76</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 bg-light text-dark">
                    <div class="p-2">
                        <h5 class="card-title">SPP Terlambat</h5>
                        <p class="card-text">50</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-light text-dark">
                    <div class="p-2">
                        <h5 class="card-title">Uang Makan Terlambat</h5>
                        <p class="card-text">50</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-light text-dark">
                    <div class="p-2">
                        <h5 class="card-title">List Tunggakan Tahun ini</h5>
                        <p class="card-text">50</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
