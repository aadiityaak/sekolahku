<?php

/**
 * Template Name: Raport Print
 *
 */

$nis       = isset($_GET['nis']) ? $_GET['nis'] : '';
// $download   = isset($_GET['download']) ? $_GET['download'] : 0;

// if (empty($raport))
//     return false;

// $args = array("post_type" => "data_raport", "s" => $raport);
// $query = get_posts($args);

// if (empty($query))
//     return false;


///Barcode
require 'vendor/autoload.php';


ob_start();
?>
<!DOCTYPE html>
<html>
<link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Raport</title>
    <style>
        .font-arab {
            font-family: 'Amiri', 'Arial', sans-serif;
            line-height: 0.75 !important;
            unicode-bidi: embed;
        }

        .kop-header {
            display: flex;
            align-items: center;
            padding-bottom: 0px;
            margin-bottom: 10px;
        }

        .kop-header img {
            width: 80px;
            height: auto;
            margin-right: 15px;
        }

        .konten-info {
            text-align: left;
        }

        body {
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            color: #000;
            margin: 0;
            /* Tambahkan ini untuk menghilangkan margin default */
            padding: 0;
            /* Tambahkan ini untuk menghilangkan padding default */
        }

        .container {
            width: 100%;
            padding: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .text-end {
            width: 250px;
            min-height: 100px;
            text-align: center;
            border-bottom: dotted 1px #ccc;
            margin-left: auto;
            margin-right: 0;
        }

        .page_break {
            page-break-before: always;
        }

        /* Mencegah page break di elemen terakhir */
        .container:last-child {
            page-break-after: avoid;
        }
    </style>
</head>

<body>
    <?php
    global $post;

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
        <?php
        $count = 0; // Inisialisasi counter
        $total_posts = $the_query->post_count; // Hitung total post
        while ($the_query->have_posts()) : $the_query->the_post();
            $count++; // Increment counter
        ?>
            <div class="container">
                <div id="contentToPrint" class="print-me">
                    <div class="kop-header" style="border-bottom: double 5px #ccc;">
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
                            <tr>
                                <td style="vertical-align: middle; text-align: left; width: 70px;">
                                    <img src="https://www.sekolahsunnahalfalah.com/wp-content/uploads/2024/11/Logo-PPTQ-AL-FALAH.png" alt="Logo Sekolah" style="width: 70px; height: auto;">
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <h3 style="margin: 0px; text-transform: uppercase;"><strong>YAYASAN AL FALAH CAWAS BIDANG PENDIDIKAN</strong></h3>
                                    <div style="margin: 0px 5px; ">
                                        <h2 style="margin-top: 5px; margin-bottom: 5px; text-transform: uppercase; color: #008000;"><strong>PONDOK PESANTREN TAHFIDZ QUR'AN AL FALAH</strong></h2>
                                    </div>
                                    <span style="display: block; font-size: 12px;">Alamat : JL. Posis-Cawas Km 1 Girimarto, Tlingsing, Cawas, Klaten 57463 Telp. 0813 2773 5771</span>
                                    <span style="display: block; font-size: 12px;">Email: pptqalfalahcawas@gmail.com | Website: www.sekolahsunnahalfalah.com</strong></span>
                                    <!-- <span style="display: block;"><strong>NPSN KB 69985347 | NPSN TK 69968851 | NPSN SD 69786372 | NPSN SMP 69947987</span> -->
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style="font-size: 14px; text-align: center; background-color: #f2f2f2; padding: 5px 10px; border: solid 1px #ccc;">
                        <span><strong>Nama:</strong> <?php echo get_the_title(get_post_meta($post->ID, 'siswa', true)); ?> | </span>
                        <span><strong>Rombel Saat Ini:</strong> <?php echo get_post_meta($post->ID, 'kelas', true); ?> | </span>
                        <span><strong>Bulan:</strong>
                            <?php
                            $bulan_value = get_post_meta($post->ID, 'bulan', true);
                            echo date_format(date_create($bulan_value), 'F Y');
                            ?>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kegiatan</th>
                            <th>Nilai</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
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

                        $average = [];
                        foreach ($data_groups as $group_name => $items) {
                            echo "<tr><td colspan='3'><b>$group_name</b></td></tr>";
                            foreach ($items as $key => $label) {
                                $nilai = get_post_meta($post->ID, $key, true);
                                echo "<tr><td>$label</td><td>$nilai</td><td>" . predikat($nilai) . "</td></tr>";
                                $average[] = $nilai;
                            }
                        }

                        $average_score = array_sum($average) / count($average);
                        $average_score_formatted = number_format($average_score, 3); // Membatasi hingga 3 angka desimal
                        echo "<tr><td><b>Rata - Rata</b></td><td><b>$average_score_formatted</b></td><td><b>" . predikat($average_score) . "</b></td></tr>";
                        ?>
                    </tbody>
                </table>
                <div style="margin-top: 15px;">
                    <b>Catatan:</b>
                    <div class="font-arab"><?php echo get_post_meta($post->ID, 'catatan', true); ?></div>
                </div>
                <div class="text-end" style="margin-top: 10px;">
                    <span>Cawas, <?php echo date('d F Y'); ?></span><br>
                    <span>Kepala Kesantrian</span>
                    <br>
                    <br>
                    <br>
                    <br>
                    <span style="display: block;"><b>( Aminuddin Nassrullah )</b></span>
                </div>
            </div>
            </div>
            <?php if ($count < $total_posts) : // Cek apakah ini bukan post terakhir 
            ?>
                <div class="page_break"></div>
            <?php endif; ?>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <center>Maaf, tidak ditemukan data dengan ID Pendaftaran tersebut.</center>
    <?php endif; ?>
</body>

</html>
<?php
$html = ob_get_clean();

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Amiri'); // Ubah ke font yang mendukung Arab
$options->set('enable_remote', true); // Mengizinkan gambar dari URL
$options->setIsHtml5ParserEnabled(true); // Enable HTML5 parser

// instantiate and use the dompdf class
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('kepribadian-' . $nis . '-' . rand(10000, 99999) . '.pdf', array('Attachment' => false));
