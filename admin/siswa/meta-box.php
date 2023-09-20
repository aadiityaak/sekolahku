<?php

/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_filter('rwmb_meta_boxes', 'sekolahku_data_siswa_meta_box');

function sekolahku_data_siswa_meta_box($meta_boxes)
{
    $prefix = '';

    $meta_boxes[] = [
        'title'      => esc_html__('Data Siswa', 'online-generator'),
        'id'         => 'siswa',
        'post_types' => ['siswa'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__('Nama Panggilan', 'online-generator'),
                'id'   => $prefix . 'nama_panggilan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('NIS', 'online-generator'),
                'id'   => $prefix . 'nis',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Jenis Kelamin', 'online-generator'),
                'id'   => $prefix . 'jenis_kelamin',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('NISN', 'online-generator'),
                'id'   => $prefix . 'nisn',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Kota Asal', 'online-generator'),
                'id'   => $prefix . 'kota_asal',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Kota Kelahiran', 'online-generator'),
                'id'   => $prefix . 'kota_kelahiran',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Tanggal Lahir', 'online-generator'),
                'id'   => $prefix . 'tanggal_lahir',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('NIK', 'online-generator'),
                'id'   => $prefix . 'nik',
            ],
            [
                'type' => 'textarea',
                'name' => esc_html__('Alamat Orangtua', 'online-generator'),
                'id'   => $prefix . 'alamat_orangtua',
            ],
            [
                'type' => 'textarea',
                'name' => esc_html__('Alamat', 'online-generator'),
                'id'   => $prefix . 'alamat',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('RT', 'online-generator'),
                'id'   => $prefix . 'rt',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('RW', 'online-generator'),
                'id'   => $prefix . 'rw',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Dusun', 'online-generator'),
                'id'   => $prefix . 'dusun',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Kelurahan', 'online-generator'),
                'id'   => $prefix . 'kelurahan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Kecamatan', 'online-generator'),
                'id'   => $prefix . 'kecamatan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Kode Pos', 'online-generator'),
                'id'   => $prefix . 'kode_pos',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Jenis Tinggal', 'online-generator'),
                'id'   => $prefix . 'jenis_tinggal',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Alat Trasnportasi', 'online-generator'),
                'id'   => $prefix . 'alat_trasnportasi',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Telephone', 'online-generator'),
                'id'   => $prefix . 'telephone',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('HP', 'online-generator'),
                'id'   => $prefix . 'hp',
            ],
            [
                'type' => 'email',
                'name' => esc_html__('Email', 'online-generator'),
                'id'   => $prefix . 'email',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('SKHUN', 'online-generator'),
                'id'   => $prefix . 'skhun',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Penerima KPS', 'online-generator'),
                'id'   => $prefix . 'penerima_kps',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Nomor KPS', 'online-generator'),
                'id'   => $prefix . 'nomor_kps',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__('Data Ayah', 'online-generator'),
        'id'         => 'ayah',
        'post_types' => ['siswa'],
        'context'    => 'normal',
        'fields'     => [

            [
                'type' => 'text',
                'name' => esc_html__('Ayah Nama Lengkap', 'online-generator'),
                'id'   => $prefix . 'ayah_nama_lengkap',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ayah Tahun Lahir', 'online-generator'),
                'id'   => $prefix . 'ayah_tahun_lahir',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ayah Pendidikan', 'online-generator'),
                'id'   => $prefix . 'ayah_pendidikan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ayah Pekerjaan', 'online-generator'),
                'id'   => $prefix . 'ayah_pekerjaan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ayah Penghsilan', 'online-generator'),
                'id'   => $prefix . 'ayah_penghsilan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ayah NIK', 'online-generator'),
                'id'   => $prefix . 'ayah_nik',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ayah HP', 'online-generator'),
                'id'   => $prefix . 'ayah_hp',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ayah Email', 'online-generator'),
                'id'   => $prefix . 'ayah_email',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__('Data Ibu', 'online-generator'),
        'id'         => 'ibu',
        'post_types' => ['siswa'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__('Ibu Nama Lengkap', 'online-generator'),
                'id'   => $prefix . 'ibu_nama_lengkap',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ibu Tahun Lahir', 'online-generator'),
                'id'   => $prefix . 'ibu_tahun_lahir',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ibu Pendidikan', 'online-generator'),
                'id'   => $prefix . 'ibu_pendidikan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ibu Pekerjaan', 'online-generator'),
                'id'   => $prefix . 'ibu_pekerjaan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ibu Penghasilan', 'online-generator'),
                'id'   => $prefix . 'ibu_penghasilan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ibu NIK', 'online-generator'),
                'id'   => $prefix . 'ibu_nik',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Ibu HP', 'online-generator'),
                'id'   => $prefix . 'ibu_hp',
            ],
            [
                'type' => 'email',
                'name' => esc_html__('Ibu Email', 'online-generator'),
                'id'   => $prefix . 'ibu_email',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__('Data Wali', 'online-generator'),
        'id'         => 'wali',
        'post_types' => ['siswa'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__('Wali Nama Lengkap', 'online-generator'),
                'id'   => $prefix . 'wali_nama_lengkap',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Wali Tahun Lahir', 'online-generator'),
                'id'   => $prefix . 'wali_tahun_lahir',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Wali Pendidikan', 'online-generator'),
                'id'   => $prefix . 'wali_pendidikan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Wali Pekerjaan', 'online-generator'),
                'id'   => $prefix . 'wali_pekerjaan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Wali Penghasilan', 'online-generator'),
                'id'   => $prefix . 'wali_penghasilan',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Wali NIK', 'online-generator'),
                'id'   => $prefix . 'wali_nik',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Wali HP', 'online-generator'),
                'id'   => $prefix . 'wali_hp',
            ],
            [
                'type' => 'email',
                'name' => esc_html__('Wali Email', 'online-generator'),
                'id'   => $prefix . 'wali_email',
            ],
        ],
    ];

    $meta_boxes[] = [
        'title'      => esc_html__('Rekap Siswa', 'online-generator'),
        'id'         => 'rekap',
        'post_types' => ['siswa'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'text',
                'name' => esc_html__('Rombel Saat Ini', 'online-generator'),
                'id'   => $prefix . 'rombel_saat_ini',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('No Peserta Ujian', 'online-generator'),
                'id'   => $prefix . 'no_peserta_ujian',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('No Seri Ijazah', 'online-generator'),
                'id'   => $prefix . 'no_seri_ijazah',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Penerima', 'online-generator'),
                'id'   => $prefix . 'penerima',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Nomor KIP', 'online-generator'),
                'id'   => $prefix . 'nomor_kip',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Nama Di KIP', 'online-generator'),
                'id'   => $prefix . 'nama_di_kip',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Nomor KKS', 'online-generator'),
                'id'   => $prefix . 'nomor_kks',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Nomor Registrasi', 'online-generator'),
                'id'   => $prefix . 'nomor_registrasi',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Bank', 'online-generator'),
                'id'   => $prefix . 'bank',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Nomor Rekening', 'online-generator'),
                'id'   => $prefix . 'nomor_rekening',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Rekening Atas', 'online-generator'),
                'id'   => $prefix . 'rekening_atas',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Layak PIP', 'online-generator'),
                'id'   => $prefix . 'layak_pip',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Kebutuhan Khusus', 'online-generator'),
                'id'   => $prefix . 'kebutuhan_khusus',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Sekolah Asal', 'online-generator'),
                'id'   => $prefix . 'sekolah_asal',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Alamat Sekolah', 'online-generator'),
                'id'   => $prefix . 'alamat_sekolah',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Status Sekolah Asal', 'online-generator'),
                'id'   => $prefix . 'status_sekolah_asal',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Anak Ke', 'online-generator'),
                'id'   => $prefix . 'anak_ke',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Agama', 'online-generator'),
                'id'   => $prefix . 'agama',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Bahasa', 'online-generator'),
                'id'   => $prefix . 'bahasa',
            ],
        ],
    ];

    return $meta_boxes;
}

// add_filter( 'rwmb_meta_boxes', 'sekolahku_siswa_meta_box' );

// function sekolahku_siswa_meta_box( $meta_boxes ) {
//     $prefix = '';

//     $meta_boxes[] = [
//         'title'      => esc_html__( 'Data Siswa', 'sekolahku' ),
//         'id'         => 'siswa',
//         'post_types' => ['siswa'],
//         'context'    => 'normal',
//         'fields'     => [
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'NIS', 'sekolahku' ),
//                 'id'   => $prefix . 'nis',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'NISN', 'sekolahku' ),
//                 'id'   => $prefix . 'nisn',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'Kelas', 'sekolahku' ),
//                 'id'   => $prefix . 'kelas',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'HP', 'sekolahku' ),
//                 'id'   => $prefix . 'hp',
//             ],
//             [
//                 'type' => 'textarea',
//                 'name' => esc_html__( 'Alamat Lengkap', 'sekolahku' ),
//                 'id'   => $prefix . 'alamat_lengkap',
//             ],
//             [
//                 'type'    => 'select',
//                 'name'    => esc_html__( 'Status', 'sekolahku' ),
//                 'id'      => $prefix . 'status',
//                 'options' => [
//                     'Aktif'     => esc_html__( 'Aktif', 'sekolahku' ),
//                     'Non Aktif' => esc_html__( 'Non Aktif', 'sekolahku' ),
//                     'Alumni'    => esc_html__( 'Alumni', 'sekolahku' ),
//                 ],
//                 'std'     => 'Aktif',
//             ],
//         ],
//     ];

//     $meta_boxes[] = [
//         'title'      => esc_html__( 'Data Wali', 'sekolahku' ),
//         'id'         => 'wali',
//         'post_types' => ['siswa'],
//         'context'    => 'normal',
//         'fields'     => [
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'Ayah', 'sekolahku' ),
//                 'id'   => $prefix . 'ayah',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'Ibu', 'sekolahku' ),
//                 'id'   => $prefix . 'ibu',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'Wali', 'sekolahku' ),
//                 'id'   => $prefix . 'wali',
//             ],
//         ],
//     ];

//     $meta_boxes[] = [
//         'title'      => esc_html__( 'Data Umum', 'sekolahku' ),
//         'id'         => 'umum',
//         'post_types' => ['siswa'],
//         'context'    => 'normal',
//         'fields'     => [
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'Jenjang Sosial', 'sekolahku' ),
//                 'id'   => $prefix . 'jenjang_sosial',
//             ],
//             [
//                 'type'       => 'post',
//                 'name'       => esc_html__( 'Saudara Kandung', 'sekolahku' ),
//                 'id'         => $prefix . 'saudara_kandung',
//                 'post_type'  => 'siswa',
//                 'field_type' => 'select_advanced',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'Orangtua Asuh', 'sekolahku' ),
//                 'id'   => $prefix . 'orangtua_asuh',
//             ],
//             [
//                 'type' => 'textarea',
//                 'name' => esc_html__( 'Alamat Orangtua Asuh', 'sekolahku' ),
//                 'id'   => $prefix . 'alamat_orangtua_asuh',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'HP Orangtua Asuh', 'sekolahku' ),
//                 'id'   => $prefix . 'hp_orangtua_asuh',
//             ]
//         ],
//     ];

//     $meta_boxes[] = [
//         'title'      => esc_html__( 'Tagihan Tetap', 'sekolahku' ),
//         'id'         => 'tagihan',
//         'post_types' => ['siswa'],
//         'context'    => 'normal',
//         'fields'     => [
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'Gedung', 'sekolahku' ),
//                 'id'   => $prefix . 'tagihan_gedung',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'Seragam', 'sekolahku' ),
//                 'id'   => $prefix . 'tagihan_seragam',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'Sarana Prasarana', 'sekolahku' ),
//                 'id'   => $prefix . 'tagihan_sarpras',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'Pendaftaran', 'sekolahku' ),
//                 'id'   => $prefix . 'tagihan_pendaftaran',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'SPP', 'sekolahku' ),
//                 'id'   => $prefix . 'tagihan_spp',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'SPP Lebih', 'sekolahku' ),
//                 'id'   => $prefix . 'spp_lebih',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'Donasi Perbulan', 'sekolahku' ),
//                 'id'   => $prefix . 'donasi_perbulan',
//             ],
//             [
//                 'type' => 'text',
//                 'name' => esc_html__( 'Subsidi Silang', 'sekolahku' ),
//                 'id'   => $prefix . 'subsidi_silang',
//             ]
//         ],
//     ];

//     return $meta_boxes;
// }