<?php

class WDS_FAQ_Class_Cmb_Test extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'WDS_FAQ_Class_Cmb') );
	}

	function test_class_access() {
		$this->assertTrue( wds_faq_page()->class-cmb instanceof WDS_FAQ_Class_Cmb );
	}
}
