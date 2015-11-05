<?php

class WDSFAQP_Wds_faqs_Test extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'WDSFAQP_Wds_faqs') );
	}

	function test_class_access() {
		$this->assertTrue( wds_faq_page()->wds-faqs instanceof WDSFAQP_Wds_faqs );
	}
}
