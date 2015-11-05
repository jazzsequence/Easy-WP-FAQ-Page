<?php

class BaseTest extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'WDS_FAQ_Page') );
	}
	
	function test_get_instance() {
		$this->assertTrue( wds_faq_page() instanceof WDS_FAQ_Page );
	}
}
