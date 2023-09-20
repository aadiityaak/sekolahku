<?php

/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_filter('rwmb_meta_boxes', 'sekolahku_tahfiz_meta_box');

function sekolahku_tahfiz_meta_box($meta_boxes)
{
    $prefix = '';
    $surat = daftar_surat();
    $meta_boxes[] = [
        'title'      => esc_html__('Detail Tahfiz', 'sekolahku'),
        'id'         => 'detail-tahfiz',
        'post_types' => ['tahfiz'],
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
                'type' => 'number',
                'name' => esc_html__('NIS', 'online-generator'),
                'id'   => $prefix . 'nis',
            ],
            [
                'type' => 'text',
                'name' => esc_html__('Kelas', 'online-generator'),
                'id'   => $prefix . 'kelas',
            ],
            [
                'type' => 'date',
                'name' => esc_html__('Tanggal', 'online-generator'),
                'id'   => $prefix . 'tanggal',
            ],
            [
                'type'    => 'select',
                'name'    => esc_html__('Jenis Setoran', 'online-generator'),
                'id'      => $prefix . 'jenis_setoran',
                'options' => [
                    '' => '-',
                    'Hafalan Baru' => esc_html__('Hafalan Baru', 'online-generator'),
                    'Murojaah'     => esc_html__('Murojaah Hafalan Baru', 'online-generator'),
                    'Murojaah Hafalan Lama'     => esc_html__('Murojaah Hafalan Lama', 'online-generator'),
                ],
            ],
            [
                'type' => 'select_advanced',
                'name' => esc_html__('Awal', 'online-generator'),
                'id'   => $prefix . 'awal',
                'options' => $surat,
            ],
            [
                'type' => 'select_advanced',
                'name' => esc_html__('Akhir', 'online-generator'),
                'id'   => $prefix . 'akhir',
                'options' => $surat,
            ],
            [
                'type' => 'number',
                'name' => esc_html__('Nilai', 'online-generator'),
                'id'   => $prefix . 'nilai',
            ],
        ],
    ];

    return $meta_boxes;
}



function daftar_surat()
{
    $cacheFile = __DIR__ . "/surat_cache.json";
    $cachedData = readCache($cacheFile);

    if (!empty($cachedData)) {
        return $cachedData;
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://equran.id/api/v2/surat",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        $data = json_decode($response);
        $data = $data->data;
        $surat = [];
        foreach ($data as $value) {

            for ($x = 1; $x <= $value->jumlahAyat; $x++) {
                $surat[$value->nomor . '_' . $value->namaLatin . '_' . $x] = $value->namaLatin . ' Ayat ' . $x;
            }

            // $surat[$value->nomor]['jumlah'] = $value->jumlahAyat;
        }

        writeCache($cacheFile, $surat);
        return $surat;
    }
}

// nomor surat
function nomor_surat($nama_surat)
{
    $cacheFile = __DIR__ . "/halaman_cache.json";
    $cachedData = readCache($cacheFile);

    if (isset($cachedData[$nama_surat])) {
        return $cachedData[$nama_surat];
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://equran.id/api/v2/surat",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        $data = json_decode($response);
        $data = $data->data;
        $nomor = '';
        foreach ($data as $value) {
            if ($value->namaLatin == $nama_surat) {
                $nomor = $value->nomor;
                // Simpan hasil permintaan di cache
                $cachedData[$nama_surat] = $nomor;
                writeCache($cacheFile, $cachedData);
            }
        }
        return $nomor;
    }
}

function readCache($cacheFile)
{
    if (file_exists($cacheFile)) {
        $cachedData = json_decode(file_get_contents($cacheFile), true);
        return $cachedData;
    }
    return array();
}

function writeCache($cacheFile, $data)
{
    file_put_contents($cacheFile, json_encode($data));
}


function my_default_title_filter()
{
    global $post_type;

    if ('tahfiz' == $post_type) {
        return '#' . date('U') . '-' . rand(00000, 99999);
    }
}
add_filter('default_title', 'my_default_title_filter');

function get_AyatData($ayah)
{
    $cacheFile = __DIR__ . "/data_ayat_cache.json";

    // Baca data cache jika sudah ada
    $cachedData = array();
    if (file_exists($cacheFile)) {
        $cachedData = json_decode(file_get_contents($cacheFile), true);
    }

    // Cek apakah data sudah ada dalam cache
    if (isset($cachedData[$ayah])) {
        return $cachedData[$ayah];
    }

    $apiUrl = "http://api.alquran.cloud/v1/ayah/{$ayah}/en.asad";

    // Inisialisasi cURL
    $curl = curl_init();

    // Set opsi cURL
    curl_setopt_array($curl, array(
        CURLOPT_URL => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    // Eksekusi cURL dan simpan respons
    $response = curl_exec($curl);
    $err = curl_error($curl);

    // Tutup cURL
    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        // Dekode respons JSON
        $data = json_decode($response, true);

        // Ambil data nomor surat, halaman, dan juz
        $surahData = array(
            'surah_number' => $data['data']['surah']['number'],
            'page' => $data['data']['page'],
            'juz' => $data['data']['juz']
        );

        // Simpan data dalam cache
        $cachedData[$ayah] = $surahData;

        // Konversi data cache ke format JSON dan simpan ke file
        file_put_contents($cacheFile, json_encode($cachedData, JSON_PRETTY_PRINT));

        return $surahData;
    }
}

// pakai api kemenag https://github.com/gadingnst/quran-api
// function nomor_halaman($nomor_surat, $nomor_ayat) {
//     $cacheFile = __DIR__."/data_cache.json";
    
//     // Cek apakah data sudah ada di cache
//     if (file_exists($cacheFile)) {
//         $cachedData = json_decode(file_get_contents($cacheFile), true);
//         if (isset($cachedData[$nomor_surat][$nomor_ayat])) {
//             $data = $cachedData[$nomor_surat][$nomor_ayat];
//             return 'Halaman <b>'.$data['page'].'</b> Juz <b>'.$data['juz'].'</b>';
//         }
//     }

//     // Lakukan permintaan ke API
//     $curl = curl_init();

//     curl_setopt_array($curl, array(
//         CURLOPT_URL => "https://api.quran.gading.dev/surah/$nomor_surat/$nomor_ayat",
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => "",
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 30,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => "GET",
//     ));

//     $response = curl_exec($curl);
//     $err = curl_error($curl);

//     curl_close($curl);

//     if ($err) {
//         return "cURL Error #:" . $err;
//     } else {
//         $data = json_decode($response);
//         $data = $data->data;
        
//         // Simpan hasil permintaan di cache
//         if ($data->meta->page !== null && $data->meta->juz !== null) {
//             // Simpan hasil permintaan di cache
//             $cachedData[$nomor_surat][$nomor_ayat] = array(
//                 'page' => $data->meta->page,
//                 'juz' => $data->meta->juz
//             );
//             file_put_contents($cacheFile, json_encode($cachedData));
//         }
        
//         return 'Halaman <b>'.$data->meta->page.'</b> Juz <b>'.$data->meta->juz.'</b>';
//     }
// }