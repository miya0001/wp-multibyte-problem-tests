<?php

class SampleTest extends WP_UnitTestCase {

	function test_sample()
	{
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	/**
	 * @test
	 */
	function check_db_charset()
	{
		global $wpdb;

		$sql = 'show table status from wordpress_test';
		$result = $wpdb->get_results($sql);

		var_dump( $result );
	}
}
