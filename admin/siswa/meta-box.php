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
                'type' => 'text',
                'name' => esc_html__( 'NIS', 'sekolahku' ),
                'id'   => $prefix . 'nis',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'NISN', 'sekolahku' ),
                'id'   => $prefix . 'nisn',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Kelas', 'sekolahku' ),
                'id'   => $prefix . 'kelas',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'HP', 'sekolahku' ),
                'id'   => $prefix . 'hp',
            ],
            [
                'type' => 'textarea',
                'name' => esc_html__( 'Alamat Lengkap', 'sekolahku' ),
                'id'   => $prefix . 'alamat',
            ],
            [
                'type'    => 'select',
                'name'    => esc_html__( 'Status', 'sekolahku' ),
                'id'      => $prefix . 'status',
                'options' => [
                    'Aktif'     => esc_html__( 'Aktif', 'sekolahku' ),
                    'Non Aktif' => esc_html__( 'Non Aktif', 'sekolahku' ),
                    'Alumni'    => esc_html__( 'Alumni', 'sekolahku' ),
                ],
                'std'     => 'Aktif',
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
                'type' => 'text',
                'name' => esc_html__( 'Jenjang Sosial', 'sekolahku' ),
                'id'   => $prefix . 'jenjang_sosial',
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
                'type' => 'text',
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
                'type' => 'text',
                'name' => esc_html__( 'Gedung', 'sekolahku' ),
                'id'   => $prefix . 'tagihan_gedung',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Seragam', 'sekolahku' ),
                'id'   => $prefix . 'tagihan_seragam',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Sarana Prasarana', 'sekolahku' ),
                'id'   => $prefix . 'tagihan_sarpras',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Pendaftaran', 'sekolahku' ),
                'id'   => $prefix . 'tagihan_pendaftaran',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'SPP', 'sekolahku' ),
                'id'   => $prefix . 'tagihan_spp',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'SPP Lebih', 'sekolahku' ),
                'id'   => $prefix . 'spp_lebih',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Donasi Perbulan', 'sekolahku' ),
                'id'   => $prefix . 'donasi_perbulan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Subsidi Silang', 'sekolahku' ),
                'id'   => $prefix . 'subsidi_silang',
            ]
        ],
    ];

    return $meta_boxes;
}