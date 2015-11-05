<?php
/**
 * WDS FAQ Page! Options
 * @version 1.0.0
 * @package WDS FAQ Page!
 */

require_once dirname( __FILE__ ) . '/../vendor/cmb2/init.php';

/**
 * WDS FAQ Options class.
 */
class WDS_FAQ_Options {
	/**
	 * Parent plugin class
	 *
	 * @var    class
	 * @since  1.0.0
	 */
	protected $plugin = null;

	/**
	 * Option key, and option page slug
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	protected $key = 'wds_faq_page_wds_faqs';

	/**
	 * Options page metabox id
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	protected $metabox_id = 'wds_faq_page_wds_faqs_metabox';

	/**
	 * Options Page title
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

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

		$this->title = __( 'WDS FAQ Page! Options', 'wds-faq-page' );
	}

	/**
	 * Initiate our hooks
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
	}

	/**
	 * Register our setting to WP
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function admin_init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function add_options_page() {
		$this->options_page = add_submenu_page(
			'options-general.php',                // Parent menu page.
			$this->title,                         // Page title.
			__( 'FAQ Page', 'wds-faq-page' ),     // Menu title.
			'manage_options',                     // Capability required.
			$this->key,                           // Menu slug.
			array( $this, 'admin_page_display' )  // Callback function.
		);

		// Include CMB CSS in the head to avoid FOUC.
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo esc_html( $this->key ); ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
	}

	/**
	 * Add custom fields to the options page.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function add_options_page_metabox() {

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove.
				'key'   => 'options-page',
				'value' => array( $this->key ),
			),
		) );

		// Add your fields here.
		$cmb->add_field( array(
			'name'    => __( 'FAQ Page', 'wds-faq-page' ),
			'desc'    => __( 'Page to display the Frequently Asked Questions.', 'wds-faq-page' ),
			'id'      => 'faq_page', // No prefix needed.
			'type'    => 'select',
			'default' => 'none',
			'options' => $this->get_page_list(),
		) );

	}

	/**
	 * Gets an array of pages for a page dropdown.
	 * @return array All the published pages.
	 */
	private function get_page_list() {
		$pages = get_pages();

		$output['none'] = __( '- Select a Page -', 'wds-faq-page' );

		foreach ( $pages as $page ) {
			$output[ $page->ID ] = $page->post_title;
		}

		return $output;
	}
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function wds_faq_get_option( $key = '' ) {
	return cmb2_get_option( 'wds_faq_page_wds_faqs', $key );
}
