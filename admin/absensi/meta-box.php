<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'rwmb_meta_boxes', 'your_prefix_register_meta_boxes_absensi' );

function your_prefix_register_meta_boxes_absensi( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'      => esc_html__( 'Detail Absensi', 'online-generator' ),
        'id'         => 'absensi',
        'post_types' => ['absensi'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__( 'Nama Siswa', 'online-generator' ),
                'id'   => $prefix . 'nama_siswa',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Id Siswa', 'online-generator' ),
                'id'   => $prefix . 'id_siswa',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Keterangan', 'online-generator' ),
                'id'   => $prefix . 'keterangan',
            ],
            [
                'type' => 'textarea',
                'name' => esc_html__( 'Deskripsi', 'online-generator' ),
                'id'   => $prefix . 'deskripsi',
            ],
        ],
    ];

    return $meta_boxes;
}