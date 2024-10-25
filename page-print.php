<?php

/**
 * Template Name: Resi Print
 *
 */

$nis       = isset($_GET['nis']) ? $_GET['nis'] : '';
// $download   = isset($_GET['download']) ? $_GET['download'] : 0;

// if (empty($resi))
//     return false;

// $args = array("post_type" => "data_resi", "s" => $resi);
// $query = get_posts($args);

// if (empty($query))
//     return false;


///Barcode
require 'vendor/autoload.php';


ob_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Resi</title>
</head>

<body>
    <?php
    global $post;

    // Query untuk mendapatkan post berdasarkan meta 'nis'
    $the_query = new WP_Query([
        'meta_query' => [
            [
                'key'     => 'nis',
                'value'   => $nis,
                'compare' => '='
            ]
        ],
        'post_type' => 'karakter'
    ]);
    ?>
    <?php if ($the_query->have_posts() && $nis) : ?>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <div class="container text-dark">
                <div id="contentToPrint" class="print-me">
                    <style>
                        .table td {
                            font-size: 11px;
                            border-top: 0 !important;
                            padding: 5px;
                        }

                        .page_break {
                            page-break-before: always;
                        }

                        body {
                            font-size: 14px;
                            font-family: 'Arial', sans-serif;
                        }
                    </style>
                    <div class="card w-100 mb-4 mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Nama
                                <b><?php echo get_the_title(get_post_meta($post->ID, 'siswa', true)); ?></b>
                            </li>
                            <li class="list-group-item">Rombel Saat Ini <b><?php echo get_post_meta($post->ID, 'kelas', true); ?></b></li>
                            <li class="list-group-item">Bulan <b><?php
                                                                    $bulan_value = get_post_meta($post->ID, 'bulan', true);
                                                                    echo date_format(date_create($bulan_value), 'F Y');
                                                                    ?></b></li>
                        </ul>
                    </div>
                    <div class="mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data_groups = [
                                    'Ibadah' => [
                                        'sholat_fardu' => 'Sholat Fardu',
                                        'sholat_rawatib' => 'Sholat Rawatib',
                                        'sholat_lail_witir' => 'Sholat Lail/Witir',
                                        'sholat_dhuha' => 'Sholat Dhuha',
                                        'sholat_syuruq' => 'Sholat Syuruq'
                                    ],
                                    'Kebersihan dan Kerapian' => [
                                        'piket' => 'Piket',
                                        'merawat_pakaian' => 'Merawat Pakaian',
                                        'ranjang_dan_lemari' => 'Ranjang dan Lemari',
                                        'kerapian_pakaian' => 'Kerapian Pakaian'
                                    ],
                                    'Kedisiplinan' => [
                                        'kehadiran_disekolah' => 'Kehadiran di Sekolah',
                                        'kehadiran_dalam_taklim' => 'Kehadiran dalam Taklim',
                                        'kehadiran_dalam_ekstrakulikuler' => 'Kehadiran dalam Ekstrakurikuler'
                                    ],
                                    'Adab dan Akhlak' => [
                                        'ketika_di_masjid' => 'Ketika di Masjid',
                                        'makan_dan_minum' => 'Makan dan Minum',
                                        'ketika_belajar' => 'Ketika Belajar',
                                        'berinteraksi_dengan_ustadz' => 'Berinteraksi dengan Ustadz',
                                        'berinteraksi_dengan_seksama' => 'Berinteraksi dengan Sesama'
                                    ]
                                ];

                                foreach ($data_groups as $group_name => $items) {
                                    echo "<tr><td colspan='3'><b>$group_name</b></td></tr>";
                                    $average = [];
                                    foreach ($items as $key => $label) {
                                        $nilai = get_post_meta($post->ID, $key, true);
                                        echo "<tr><td class='ps-3'>$label</td><td>$nilai</td><td>" . predikat($nilai) . "</td></tr>";
                                        $average[] = $nilai;
                                    }
                                }

                                $average_score = array_sum($average) / count($average);
                                echo "<tr class='bg-light'><td class='ps-3'><b>Rata - Rata</b></td><td><b>$average_score</b></td><td><b>" . predikat($average_score) . "</b></td></tr>";
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        <b class="p-1">Catatan :</b>
                        <div class="p-1"><?php echo get_post_meta($post->ID, 'catatan', true); ?></div>
                    </div>
                    <div class="text-end" style="border-bottom: 1px dotted #cccccc; width: 200px; margin: 0 auto; text-align: center; margin-top: 30px;">
                        <span>Cawas, <?php echo date('d F Y'); ?></span><br>
                        <span>Kepala Kesantrian</span><br><br><br>
                    </div>
                </div>
            </div>
            <div class="page_break"></div>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <center>Maaf, tidak ditemukan data dengan ID Pendaftaran tersebut.</center>
    <?php endif; ?>
</body>

</html>
<?php
$html = ob_get_clean();



// reference the Dompdf namespace
// require_once VELOCITY_EXPEDISI_DIR_PATH('inc/lib/dompdf/vendor/autoload.php');
// require_once(VELOCITY_EXPEDISI_DIR_PATH.'lib/dompdf/vendor/autoload.php');
use Dompdf\Dompdf;
// use Dompdf\Options;

// $options = new Options();
// $options->set('defaultFont', 'Helvetica');
// $options->set('enable_remote', true);


// instantiate and use the dompdf class
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'potrait');
// $dompdf->setPaper(array(0, 0, 300, 300), 'potrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('kepribadian-' . $nis . '-' . rand(10000, 99999) . 'pdf', array('Attachment' => false));
