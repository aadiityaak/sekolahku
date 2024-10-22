<?php

/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_filter( 'rwmb_meta_boxes', 'your_prefix_register_meta_boxes_karakter' );

function your_prefix_register_meta_boxes_karakter( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'      => esc_html__( 'Detail Santri', 'online-generator' ),
        'id'         => 'detail_santri',
        'post_types' => 'karakter',
        'context'    => 'normal',
        'fields'     => [
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
                'type' => 'text',
                'name' => esc_html__( 'Kelas', 'online-generator' ),
                'id'   => $prefix . 'kelas',
            ],
            [
                'type' => 'date',
                'name' => esc_html__( 'Bulan', 'online-generator' ),
                'id'   => $prefix . 'bulan',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Nis', 'online-generator' ),
                'id'   => $prefix . 'nis',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__( 'Kegiatan Ibadah', 'online-generator' ),
        'id'         => 'kegiatan_ibadah',
        'post_types' => 'karakter',
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'number',
                'name' => esc_html__( 'Sholat Fardu', 'online-generator' ),
                'id'   => $prefix . 'sholat_fardu',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Sholat Rawatib', 'online-generator' ),
                'id'   => $prefix . 'sholat_rawatib',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Sholat Lail/Witir', 'online-generator' ),
                'id'   => $prefix . 'sholat_lail_witir',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Sholat Dhuha', 'online-generator' ),
                'id'   => $prefix . 'sholat_dhuha',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Sholat Syuruq', 'online-generator' ),
                'id'   => $prefix . 'sholat_syuruq',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__( 'Kegiatan Keberihan dan Kerapian', 'online-generator' ),
        'id'         => 'kegiatan_kebersihan_dan_kerapian',
        'post_types' => 'karakter',
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'number',
                'name' => esc_html__( 'Piket', 'online-generator' ),
                'id'   => $prefix . 'piket',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Merawat Pakaian', 'online-generator' ),
                'id'   => $prefix . 'merawat_pakaian',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Ranjang dan Lemari', 'online-generator' ),
                'id'   => $prefix . 'ranjang_dan_lemari',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Kerapian Pakaian', 'online-generator' ),
                'id'   => $prefix . 'kerapian_pakaian',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__( 'Kegiatan Kedisiplinan', 'online-generator' ),
        'id'         => 'kegiatan_kedisiplinan',
        'post_types' => 'karakter',
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'number',
                'name' => esc_html__( 'Kehadiran Disekolah', 'online-generator' ),
                'id'   => $prefix . 'kehadiran_disekolah',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Kehadiran dalam Taklim', 'online-generator' ),
                'id'   => $prefix . 'kehadiran_dalam_taklim',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Kehadiran dalam Ekstrakulikuler', 'online-generator' ),
                'id'   => $prefix . 'kehadiran_dalam_ekstrakulikuler',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__( 'Kegiatan Adab dan Akhlak', 'online-generator' ),
        'id'         => 'kegiatan_adab_dan_akhlak',
        'post_types' => 'karakter',
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'number',
                'name' => esc_html__( 'Ketika di Masjid', 'online-generator' ),
                'id'   => $prefix . 'ketika_di_masjid',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Makan dan Minum', 'online-generator' ),
                'id'   => $prefix . 'makan_dan_minum',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Ketika Belajar', 'online-generator' ),
                'id'   => $prefix . 'ketika_belajar',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Berinteraksi dengan Ustadz', 'online-generator' ),
                'id'   => $prefix . 'berinteraksi_dengan_ustadz',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Berinteraksi dengan Seksama', 'online-generator' ),
                'id'   => $prefix . 'berinteraksi_dengan_seksama',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__( 'Catatan', 'online-generator' ),
        'id'         => 'catatan',
        'post_types' => 'karakter',
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'textarea',
                'name' => esc_html__( 'Catatan', 'online-generator' ),
                'id'   => $prefix . 'catatan',
            ],
        ],
    ];

    return $meta_boxes;
}