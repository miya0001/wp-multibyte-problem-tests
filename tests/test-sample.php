<?php

class SampleTest extends WP_UnitTestCase
{
	public function setup()
	{
		define( 'DB_CHARSET', 'utf8' );
		define( 'DB_COLLATE', 'utf8_general_ci' );
	}

	/**
	 * @test
	 */
	function utf8_testing()
	{
		global $wpdb;
		$this->assertSame( $wpdb->charset, 'utf8' );

		$post_id = $this->factory->post->create( array(
			'post_title' => '日本語のタイトル',
			'post_content' => 'こんにちは！世界！',
		) );

		$this->assertTrue( 0 < $post_id );

		$post = get_post( $post_id );

		$this->assertSame( $post->post_title, '日本語のタイトル' );
		$this->assertSame( $post->post_content, 'こんにちは！世界！' );
	}
}
