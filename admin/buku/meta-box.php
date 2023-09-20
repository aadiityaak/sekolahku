<?php
/**
 * Sweetaddon functions
 *
 * @package Sweetaddon
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'rwmb_meta_boxes', 'your_prefix_register_meta_boxes' );

function your_prefix_register_meta_boxes( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'      => esc_html__( 'Detail Buku', 'online-generator' ),
        'id'         => 'buku',
        'post_types' => ['buku'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'number',
                'name' => esc_html__( 'Stok Buku', 'online-generator' ),
                'id'   => $prefix . 'stok_buku',
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Harga Buku', 'online-generator' ),
                'id'   => $prefix . 'harga_buku',
            ],
        ],
    ];

    return $meta_boxes;
}