<?php
/**
 * Polylang related functions and strings.
 *
 * @package Everlasting
 */

/**
 * Register strings for translation.
 */
if ( function_exists( 'pll_register_string' ) ) {
	pll_register_string( esc_html__( 'Footer title', 'everlasting' ), get_theme_mod( 'footer_title' ), 'everlasting' );
	pll_register_string( esc_html__( 'Footer text', 'everlasting' ), get_theme_mod( 'footer_text' ), 'everlasting', true );
	pll_register_string( esc_html__( 'School title', 'everlasting' ), get_theme_mod( 'school_title' ), 'everlasting' );
	pll_register_string( esc_html__( 'School description', 'everlasting' ), get_theme_mod( 'school_desc' ), 'everlasting', true );
	pll_register_string( esc_html__( 'School extra title', 'everlasting' ), get_theme_mod( 'school_extra_title' ), 'everlasting' );
	pll_register_string( esc_html__( 'School extra description', 'everlasting' ), get_theme_mod( 'school_extra_desc' ), 'everlasting', true );
	pll_register_string( esc_html__( 'Service title', 'everlasting' ), get_theme_mod( 'service_title' ), 'everlasting' );
	pll_register_string( esc_html__( 'Service description', 'everlasting' ), get_theme_mod( 'service_desc' ), 'everlasting', true );
	pll_register_string( esc_html__( 'Service extra title', 'everlasting' ), get_theme_mod( 'service_extra_title' ), 'everlasting' );
	pll_register_string( esc_html__( 'Service extra description', 'everlasting' ), get_theme_mod( 'service_extra_desc' ), 'everlasting', true );
}
