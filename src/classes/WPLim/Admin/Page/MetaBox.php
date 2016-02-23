<?php
/**
 * Class WPLim_Admin_Page_MetaBox
 *
 * Creating admin options page with metaboxes
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
class WPLim_Admin_Page_MetaBox_0x4x0 extends WPLim_Admin_Page_Abstract_0x4x0
{

    /**
     * Additional Settings
     * @var array
     */
    protected $additionalSettings = array(
        'defaultColumns' => 2,
        'maxColumns'     => 2,
        'bodyTemplate'   => 'body-content.php',
    );

    /**
     * Constructor
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        // add additional settings
        $completeSettings = array_merge($this->additionalSettings, $settings);

        parent::__construct($completeSettings);
    }

    /**
     * Load page
     */
    protected function loadPage()
    {
        parent::loadPage();

        // set dashboard postbox
        wp_enqueue_script('dashboard');

        // screen settings
        add_screen_option('layout_columns', array(
            'max'       => $this->settings['maxColumns'],
            'default'   => $this->settings['defaultColumns']
        ));

        // add template vars
        $this->templateVars['bodyTemplate'] = $this->settings['bodyTemplate'];
        $this->templateVars['columnCount'] = (1 == get_current_screen()->get_columns()) ? 1 : 2;
    }

}

/*?>*/
