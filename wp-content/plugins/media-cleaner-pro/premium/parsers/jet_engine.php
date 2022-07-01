<?php

add_action( 'wpmc_scan_once', 'wpmc_scan_once_jet_engine', 10, 0 );

function wpmc_jet_engine_handle_post_slugs_defs( &$wpmc_jet_engine_post_slugs_def, $slug, $meta_fields ) {
  if ( empty( $meta_fields ) ) {
    return;
  }
  foreach ( $meta_fields as $meta_field ) {
    if ( $meta_field['type'] === 'media' || $meta_field['type'] === 'gallery' ) {
      if ( !isset( $wpmc_jet_engine_post_slugs_def[$slug] ) ) {
        $wpmc_jet_engine_post_slugs_def[$slug] = [];
      }
      array_push( $wpmc_jet_engine_post_slugs_def[$slug], 
        array(
          'name' => $meta_field['name'],
          'type' => $meta_field['type']
          )
        );
    }
  }
}

function wpmc_scan_once_jet_engine() {
  global $wpdb;

  // Post Types
  $wpmc_jet_engine_post_slugs = [];
  $wpmc_jet_engine_post_slugs_def = [];
  $jet_post_types_table = $wpdb->prefix . "jet_post_types";
	$jet_post_types = $wpdb->get_results( "SELECT slug, meta_fields
    FROM {$jet_post_types_table} 
    WHERE status = 'publish'", ARRAY_A );
	foreach ( $jet_post_types as $jet_post_type ) {
    $slug = $jet_post_type['slug'];
    $wpmc_jet_engine_post_slugs[] = $slug;
    $wpmc_jet_engine_post_slugs_def[$slug] = [];
    $meta_fields = unserialize( $jet_post_type['meta_fields'] );
    wpmc_jet_engine_handle_post_slugs_defs( $wpmc_jet_engine_post_slugs_def, $slug, $meta_fields );
	}

  // Meta Boxes
  $metaboxes = get_option( 'jet_engine_meta_boxes' );
  if ( !empty( $metaboxes ) ) {
    foreach ( $metaboxes as $metabox ) {
      $slugs = empty( $metabox['args']['allowed_post_type'] ) ? [] : $metabox['args']['allowed_post_type'];
      if ( !empty( $metabox['args']['allowed_posts'] ) ) {
        $slugs[] = 'post';
        if ( !in_array( 'post', $wpmc_jet_engine_post_slugs, true ) ) {
          $wpmc_jet_engine_post_slugs[] = 'post';
        }
      }
      foreach ( $slugs as $slug ) {
        wpmc_jet_engine_handle_post_slugs_defs( $wpmc_jet_engine_post_slugs_def, $slug, $metabox['meta_fields'] );
      }
    }
  }

  set_transient( 'wpmc_jet_engine_post_types', $wpmc_jet_engine_post_slugs, MONTH_IN_SECONDS );
  set_transient( 'wpmc_jet_engine_post_types_def', $wpmc_jet_engine_post_slugs_def, MONTH_IN_SECONDS );
}	

add_action( 'wpmc_scan_postmeta', 'wpmc_scan_postmeta_jet_engine', 10, 1 );

function wpmc_scan_postmeta_jet_engine( $id ) {
  global $wpmc;

  $wpmc_jet_engine_post_slugs = get_transient( 'wpmc_jet_engine_post_types' );
  $wpmc_jet_engine_post_slugs_def = get_transient( 'wpmc_jet_engine_post_types_def' );

  $type = get_post_type( $id );
  if ( !is_array( $wpmc_jet_engine_post_slugs ) || !is_array( $wpmc_jet_engine_post_slugs_def ) || 
    !in_array( $type, $wpmc_jet_engine_post_slugs ) ) {
    return;
  }

  $jet_engine_post_type_def = $wpmc_jet_engine_post_slugs_def[$type];
  foreach ( $jet_engine_post_type_def as $field ) {
    $value = get_post_meta( $id, $field['name'], true );
    if ( $field['type'] === 'gallery' ) {
      $value = explode( ',', $value );
      $value = array_map( 'intval', $value );
    }
    else {
      $value = (int)$value;
    }
    $wpmc->add_reference_id( $value, 'JET ENGINE META (ID)' );
  }
}

?>