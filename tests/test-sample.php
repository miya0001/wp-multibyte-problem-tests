<?php

class SampleTest extends WP_UnitTestCase
{
	function setup()
	{
		global $wpdb;
		$this->charset = 'utf8';
	}

	/**
	 * @test
	 */
	function utf8_testing()
	{
		$char = array(
			'utf8' => 'UTF-8',
			'ujis' => 'EUC-JP',
		);

		// $this->assertSame( $_ENV['WP_DB_CHARSET'], $wpdb->charset );
		$post_id = wp_insert_post( array(
			'post_status' => 'publish',
			'post_title' => mb_convert_encoding( 'こんにちは！', $char[ $_SERVER['WP_DB_CHARSET'] ], 'utf8' ),
			'post_content' => mb_convert_encoding( '世界へようこそ', $char[ $_SERVER['WP_DB_CHARSET'] ], 'utf8' ),
		) );

		$this->assertTrue( 0 < $post_id );

		$post = get_post( $post_id );

		$this->assertSame( $post->post_title, 'こんにちは！' );
		$this->assertSame( $post->post_content, '世界へようこそ' );
	}
}
