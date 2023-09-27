<?php

/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_filter( 'rwmb_meta_boxes', 'your_prefix_register_meta_boxes_form_ppdb' );

function your_prefix_register_meta_boxes_form_ppdb( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'      => esc_html__( 'Detail Form PPDB', 'online-generator' ),
        'id'         => 'detail_form_ppdb',
        'post_types' => 'form-ppdb',
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__( 'Nama Lengkap', 'online-generator' ),
                'id'   => $prefix . 'nama_lengkap_form',
            ],
            // [
            //     'type' => 'number',
            //     'name' => esc_html__( 'NIS', 'online-generator' ),
            //     'id'   => $prefix . 'nis_form',
            // ],
            [
                'type'        => 'text',
                'name'        => esc_html__( 'Jenis Kelamin', 'online-generator' ),
                'id'          => $prefix . 'jenis_kelamin_form',
            ],
            // [
            //     'type' => 'number',
            //     'name' => esc_html__( 'NISN', 'online-generator' ),
            //     'id'   => $prefix . 'nisn_form',
            // ],
            [
                'type' => 'textarea',
                'name' => esc_html__( 'Alamat', 'online-generator' ),
                'id'   => $prefix . 'alamat_form',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Tempat Lahir', 'online-generator' ),
                'id'   => $prefix . 'tempat_lahir_form',
            ],
            [
                'type' => 'date',
                'name' => esc_html__( 'Tanggal Lahir', 'online-generator' ),
                'id'   => $prefix . 'tanggal_lahir_form',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Asal Sekolah', 'online-generator' ),
                'id'   => $prefix . 'asal_sekolah_form',
            ],
            [
                'type' => 'email',
                'name' => esc_html__( 'Email', 'online-generator' ),
                'id'   => $prefix . 'email__siswa_form',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'Nomor Telephon', 'online-generator' ),
                'id'   => $prefix . 'nomor_telephon_form',
            ],
            [
                'type'        => 'text',
                'name'        => esc_html__( 'Jenjang Sekolah', 'online-generator' ),
                'id'          => $prefix . 'jenjang_sekolah_form',
            ],
            // [
            //     'type' => 'text',
            //     'name' => esc_html__( 'Nama Ayah', 'online-generator' ),
            //     'id'   => $prefix . 'nama_ayah_form',
            // ],
            // [
            //     'type' => 'text',
            //     'name' => esc_html__( 'Nama Ibu', 'online-generator' ),
            //     'id'   => $prefix . 'nama_ibu_form',
            // ],
            [
                'type' => 'file_advanced',
                'name' => esc_html__( 'Documen (PDF)', 'online-generator' ),
                'id'   => $prefix . 'documen_pdf_form',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__( 'Detail Sekolah', 'online-generator' ),
        'id'         => 'detail_sekolah',
        'post_types' => 'form-ppdb',
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__( 'Asal Sekolah', 'online-generator' ),
                'id'   => $prefix . 'asal_sekolah_form',
            ],
            [
                'type' => 'textarea',
                'name' => esc_html__( 'Alamat Sekolah', 'online-generator' ),
                'id'   => $prefix . 'alamat_sekolah_form',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__( 'Detail Orang Tua', 'online-generator' ),
        'id'         => 'detail_orang_tua',
        'post_types' => 'form-ppdb',
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__( 'Nama Ayah', 'online-generator' ),
                'id'   => $prefix . 'nama_ayah_form',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'No. Phone Ayah', 'online-generator' ),
                'id'   => $prefix . 'no_phone_ayah_form',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Nama Ibu', 'online-generator' ),
                'id'   => $prefix . 'nama_ibu_form',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'No. Phone Ibu', 'online-generator' ),
                'id'   => $prefix . 'no_phone_ibu_form',
            ],
            [
                'type' => 'textarea',
                'name' => esc_html__( 'Alamat Orang Tua', 'online-generator' ),
                'id'   => $prefix . 'alamat_orang_tua_form',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__( 'Detail Wali', 'online-generator' ),
        'id'         => 'detail_wali',
        'post_types' => 'form-ppdb',
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__( 'Nama Wali', 'online-generator' ),
                'id'   => $prefix . 'nama_wali_form',
            ],
            [
                'type' => 'number',
                'name' => esc_html__( 'No. Phone Wali', 'online-generator' ),
                'id'   => $prefix . 'no_phone_wali_form',
            ],
            [
                'type' => 'textarea',
                'name' => esc_html__( 'Alamat Wali', 'online-generator' ),
                'id'   => $prefix . 'alamat_wali_form',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__( 'Detail Status', 'online-generator' ),
        'id'         => 'detail_status',
        'post_types' => 'form-ppdb',
        'context'    => 'normal',
        'fields'     => [
            [
                'type'    => 'select',
                'name'    => esc_html__( 'Status', 'online-generator' ),
                'id'      => $prefix . 'status',
                'options' => [
                    'Pengajuan'                 => esc_html__( 'Pengajuan', 'online-generator' ),
                    'Belum Membayar Registrasi' => esc_html__( 'Belum Membayar Registrasi', 'online-generator' ),
                    'Teregristasi'              => esc_html__( 'Teregristasi', 'online-generator' ),
                    'Regristasi Gagal'          => esc_html__( 'Regristasi Gagal', 'online-generator' ),
                ],
                'placeholder' => esc_html__( 'Pilih Opsi', 'online-generator' ),
            ],
        ],
    ];

    return $meta_boxes;
}