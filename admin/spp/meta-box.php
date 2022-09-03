<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'rwmb_meta_boxes', 'sekolahku_spp_meta_box' );

function sekolahku_spp_meta_box( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'      => esc_html__( 'Detail SPP', 'sekolahku' ),
        'id'         => 'spp',
        'post_types' => ['spp'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__( 'NIS', 'sekolahku' ),
                'id'   => $prefix . 'nis',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Bulan', 'sekolahku' ),
                'id'   => $prefix . 'bulan',
                'desc' => 'Format: 06-2022'
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Nominal', 'sekolahku' ),
                'id'   => $prefix . 'nominal',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Tanggal Dibayar', 'sekolahku' ),
                'id'   => $prefix . 'tanggal_dibayar',
                'desc' => 'Format: 23-06-2022'
            ],
            [
                'type'    => 'select_advanced',
                'name'    => esc_html__( 'Status', 'online-generator' ),
                'id'      => $prefix . 'status',
                'options' => [
                    '' => esc_html__( 'Belum dibayar', 'online-generator' ),
                    'lunas'         => esc_html__( 'Lunas', 'online-generator' ),
                ],
            ],
        ],
    ];

    return $meta_boxes;
}