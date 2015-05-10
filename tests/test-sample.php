<?php

class SampleTest extends WP_UnitTestCase
{
	/**
	 * @test
	 */
	function utf8_testing()
	{
		global $wpdb;
		$wpdb->charset = 'utf8';
		$wpdb->collate = 'utf8_general_ci';

		$post_id = $this->factory->post->create( array(
			'post_title' => '日本語のタイトル',
			'post_content' => 'こんにちは！世界！',
		) );

		$this->assertTrue( 0 < $post_id );

		$post = get_post( $post_id );

		$this->assertSame( $post->post_title, '日本語のタイトル' );
		$this->assertSame( $post->post_content, 'こんにちは！世界！' );
	}

	/**
	 * @test
	 */
	function ujis_testing()
	{
		global $wpdb;
		$wpdb->charset = 'ujis';
		$wpdb->collate = 'ujis_japanese_ci';

		$post_id = $this->factory->post->create( array(
			'post_title' => mb_convert_encoding( '日本語のタイトル', 'EUC-JP', 'UTF-8' ),
			'post_content' => mb_convert_encoding( 'こんにちは！世界！', 'EUC-JP', 'UTF-8' ),
		) );

		$this->assertTrue( 0 < $post_id );

		$post = get_post( $post_id );

		$this->assertSame( $post->post_title, '日本語のタイトル' );
		$this->assertSame( $post->post_content, 'こんにちは！世界！' );
	}
}
