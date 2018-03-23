<?php
/**
 * The template for displaying all Doctor posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package weddingvendor
 */

get_header(); 

$list_style=tg_get_option('items_display_style');
get_template_part( 'template-parts/item/vendor', $list_style );

get_footer(); ?>