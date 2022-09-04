<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Register a custom menu page.
 */
function sekolahku_dasboard(){
    add_menu_page( 
        __( 'Dashboard Sekolah', 'textdomain' ),
        'Dashboard',
        'manage_options',
        'dashboard-sekolah',
        'sekolahku_view_dashboard',
        SEKOLAHKU_URL .'asset/img/school.png',
        6
    ); 
}
add_action( 'admin_menu', 'sekolahku_dasboard' );

function sekolahku_view_dashboard() {
    ?>
        <div class="container py-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="card border-0 bg-gradient-1 text-white">
                        <div class="p-2">
                            <h5 class="card-title">TKB</h5>
                            <p class="card-text">50</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 bg-gradient-1 text-white">
                        <div class="p-2">
                            <h5 class="card-title">SD</h5>
                            <p class="card-text">300</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 bg-gradient-1 text-white">
                        <div class="p-2">
                            <h5 class="card-title">SMP</h5>
                            <p class="card-text">234</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 bg-gradient-1 text-white">
                        <div class="p-2">
                            <h5 class="card-title">PONDOK</h5>
                            <p class="card-text">76</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <canvas id="spp-sd" width="835" height="370"></canvas>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 bg-gradient-1 text-white">
                        <div class="p-2">
                            <h5 class="card-title">PONDOK</h5>
                            <p class="card-text">76</p>
                        </div>
                    </div>
                    <div class="card border-0 bg-gradient-1 text-white">
                        <div class="p-2">
                            <h5 class="card-title">PONDOK</h5>
                            <p class="card-text">76</p>
                        </div>
                    </div>
                    <div class="card border-0 bg-gradient-1 text-white">
                        <div class="p-2">
                            <h5 class="card-title">PONDOK</h5>
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