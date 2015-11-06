<?php
/**
 * Helper Functions for templates.
 *
 * @package WDS FAQ Page!
 */

/**
 * Gets an array of all the questions for the given post ID (or the current post ID if none was passed).
 * @param  integer $post_id The post ID of the FAQ page.
 * @return array            The FAQ questions and answers.
 */
function wds_faq_get_questions( $post_id = 0 ) {
	// If no post ID was passed, attempt to get one.
	if ( ! $post_id ) {
		$post_id = get_queried_object_id();
	}

	return get_post_meta( $post_id, '_wds_faq_group', true );
}
