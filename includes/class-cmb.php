<?php
/**
 * WDS FAQ Page! CMB
 * @version 1.0.0
 * @package WDS FAQ Page!
 */

require_once dirname( __FILE__ ) . '/../vendor/cmb2/init.php';

/**
 * WDS FAQ CMB Class
 */
class WDS_FAQ_CMB {
	/**
	 * Parent plugin class
	 *
	 * @var   class
	 * @since 1.0.0
	 */
	protected $plugin = null;

	/**
	 * Meta prefix
	 *
	 * @var   string
	 * @since 1.0.0
	 */
	protected $prefix = '_wds_faq_';

	/**
	 * Constructor
	 *
	 * @param  object $plugin Parent plugin class.
	 * @since  1.0.0
	 * @return void
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function hooks() {
		add_action( 'cmb2_admin_init', array( $this, 'do_meta_boxes' ) );
	}

	/**
	 * Handles the CMB2 boxes.
	 * @return void
	 */
	public function do_meta_boxes() {

		$cmb = new_cmb2_box( array(
			'id'           => $this->prefix . 'metabox',
			'title'        => esc_html( __( 'Frequently Asked Questions', 'wds-faq-page' ) ),
			'object_types' => array( 'page' ),
			'context'      => 'normal',
			'priority'     => 'high',
			'show_on'      => array(
				'key'   => 'id',
				'value' => $this->show_on(),
			),
		) );

		$group_field_id = $cmb->add_field( array(
			'id'      => $this->prefix . 'group',
			'type'    => 'group',
			'options' => array(
				'group_title'   => esc_html__( 'Question #{#}', 'wds-faq-page' ),
				'add_button'    => esc_html__( 'Add another question', 'wds-faq-page' ),
				'remove_button' => esc_html__( 'Remove question', 'wds-faq-page' ),
				'sortable'      => true,
			),
		) );

		$cmb->add_group_field( $group_field_id, array(
			'name' => esc_html__( 'Question', 'wds-faq-page' ),
			'id'   => 'question',
			'type' => 'text',
		) );

		$cmb->add_group_field( $group_field_id, array(
			'name' => esc_html__( 'Answer', 'wds-faq-page' ),
			'id'   => 'answer',
			'type' => 'wysiwyg',
			'options' => array(
				'teeny'         => true,
				'media_buttons' => false,
				'textarea_rows' => 10,
			),
		) );

	}

	/**
	 * Get the FAQ page ID from the option if set.
	 * @return int Either a page ID or 0 if no FAQ page is set.
	 */
	private function show_on() {
		$page_id = wds_faq_get_option( 'faq_page' );

		if ( $page_id && 'none' !== $page_id ) {
			return absint( $page_id );
		} else {
			return 0;
		}
	}
}
