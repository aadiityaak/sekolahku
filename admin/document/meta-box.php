<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'rwmb_meta_boxes', 'sekolahku_dokumen_meta_box' );

function sekolahku_dokumen_meta_box( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'      => esc_html__( 'Data Dokumen', 'sekolahku' ),
        'id'         => 'dokumen',
        'post_types' => ['document'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'file_advanced',
                'name' => esc_html__( 'Dokumen', 'sekolahku' ),
                'id'   => $prefix . 'document_id',
            ],
            [
            'type'       => 'post',
            'name'       => esc_html__('Siswa', 'online-generator'),
            'id'         => $prefix . 'siswa',
            'post_type'  => 'siswa',
            'field_type' => 'select_advanced',
            'query_args' => [
                '' => '',
            ],
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'NIS', 'online-generator' ),
                'id'   => $prefix . 'nis',
            ],
        ],
    ];

    return $meta_boxes;
}