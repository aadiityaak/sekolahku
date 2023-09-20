<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'rwmb_meta_boxes', 'sekolahku_keuangan_meta_box' );

function sekolahku_keuangan_meta_box( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'      => esc_html__( 'Detail Pembayaran', 'sekolahku' ),
        'id'         => 'tagihan',
        'post_types' => ['keuangan'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'user',
                'name' => esc_html__( 'Siswa', 'sekolahku' ),
                'id'   => $prefix . 'siswa',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Nama Tagihan', 'sekolahku' ),
                'id'   => $prefix . 'nama_tagihan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Nominal', 'sekolahku' ),
                'id'   => $prefix . 'nominal',
            ],
            [
                'type' => 'datetime',
                'name' => esc_html__( 'Tanggal Dibayar', 'sekolahku' ),
                'id'   => $prefix . 'dibayar',
            ],
            [
                'type' => 'datetime',
                'name' => esc_html__( 'Jatuh Tempo', 'sekolahku' ),
                'id'   => $prefix . 'tempo',
            ]
        ],
    ];

    return $meta_boxes;
}