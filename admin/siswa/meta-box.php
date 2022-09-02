<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'rwmb_meta_boxes', 'sekolahku_siswa_meta_box' );

function sekolahku_siswa_meta_box( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'      => esc_html__( 'Data Siswa', 'sekolahku' ),
        'id'         => 'siswa',
        'post_types' => ['siswa'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'number',
                'name' => esc_html__( 'NIS', 'sekolahku' ),
                'id'   => $prefix . 'nis',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'NISN', 'sekolahku' ),
                'id'   => $prefix . 'nisn',
            ],
            [
                'type'    => 'select_advanced',
                'name'    => esc_html__( 'Kelas', 'sekolahku' ),
                'id'      => $prefix . 'kelas',
                'options' => [
                    'TK'    => esc_html__( 'TK', 'sekolahku' ),
                    'SD-1A' => esc_html__( 'SD-1A', 'sekolahku' ),
                    'SD-1B' => esc_html__( 'SD-1B', 'sekolahku' ),
                    'SD-2A' => esc_html__( 'SD-2A', 'sekolahku' ),
                    'SD-2B' => esc_html__( 'SD-2B', 'sekolahku' ),
                    'SD-3A' => esc_html__( 'SD-3A', 'sekolahku' ),
                    'SD-3B' => esc_html__( 'SD-3B', 'sekolahku' ),
                    'SD-4A' => esc_html__( 'SD-4A', 'sekolahku' ),
                    'SD-4B' => esc_html__( 'SD-4B', 'sekolahku' ),
                    'SD-5A' => esc_html__( 'SD-5A', 'sekolahku' ),
                    'SD-5B' => esc_html__( 'SD-5B', 'sekolahku' ),
                    'SD-6A' => esc_html__( 'SD-6A', 'sekolahku' ),
                    'SD-6B' => esc_html__( 'SD-6B', 'sekolahku' ),
                    'SMP-7' => esc_html__( 'SMP-7', 'sekolahku' ),
                    'SMP-8' => esc_html__( 'SMP-8', 'sekolahku' ),
                    'SMP-9' => esc_html__( 'SMP-9', 'sekolahku' ),
                ],
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'HP', 'sekolahku' ),
                'id'   => $prefix . 'hp',
            ],
            [
                'type' => 'textarea',
                'name' => esc_html__( 'Alamat Lengkap', 'sekolahku' ),
                'id'   => $prefix . 'alamat',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__( 'Data Wali', 'sekolahku' ),
        'id'         => 'wali',
        'post_types' => ['siswa'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__( 'Ayah', 'sekolahku' ),
                'id'   => $prefix . 'ayah',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Ibu', 'sekolahku' ),
                'id'   => $prefix . 'ibu',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Wali', 'sekolahku' ),
                'id'   => $prefix . 'wali',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__( 'Data Umum', 'sekolahku' ),
        'id'         => 'umum',
        'post_types' => ['siswa'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type'    => 'select_advanced',
                'name'    => esc_html__( 'Jenjang Sosial', 'sekolahku' ),
                'id'      => $prefix . 'jenjang_sosial',
                'options' => [
                    'A'    => esc_html__( 'A', 'sekolahku' ),
                    'B'    => esc_html__( 'B', 'sekolahku' ),
                    'C'    => esc_html__( 'C', 'sekolahku' ),
                    'D'    => esc_html__( 'D', 'sekolahku' ),
                ],
            ],
            [
                'type'       => 'post',
                'name'       => esc_html__( 'Saudara Kandung', 'sekolahku' ),
                'id'         => $prefix . 'saudara_kandung',
                'post_type'  => 'siswa',
                'field_type' => 'select_advanced',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Orangtua Asuh', 'sekolahku' ),
                'id'   => $prefix . 'orangtua_asuh',
            ],
            [
                'type' => 'textarea',
                'name' => esc_html__( 'Alamat Orangtua Asuh', 'sekolahku' ),
                'id'   => $prefix . 'alamat_orangtua_asuh',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'HP Orangtua Asuh', 'sekolahku' ),
                'id'   => $prefix . 'hp_orangtua_asuh',
            ]
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__( 'Tagihan Tetap', 'sekolahku' ),
        'id'         => 'tagihan',
        'post_types' => ['siswa'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'number',
                'name' => esc_html__( 'Gedung', 'sekolahku' ),
                'id'   => $prefix . 'tagihan_gedung',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Seragam', 'sekolahku' ),
                'id'   => $prefix . 'tagihan_seragam',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Sarana Prasarana', 'sekolahku' ),
                'id'   => $prefix . 'tagihan_sarpras',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Pendaftaran', 'sekolahku' ),
                'id'   => $prefix . 'tagihan_pendaftaran',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'SPP', 'sekolahku' ),
                'id'   => $prefix . 'tagihan_spp',
            ]
        ],
    ];

    return $meta_boxes;
}