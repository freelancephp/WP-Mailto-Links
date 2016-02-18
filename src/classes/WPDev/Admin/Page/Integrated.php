<?php
/**
 * Class WPDev_Admin_Page_Integrated
 *
 * Create admin page with help-tabs and meta-boxes
 *
 * @package  WPDev
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPDev
 * @license  MIT license
 */
class WPDev_Admin_Page_Integrated_0x4x0 implements WPDev_Admin_Page_Interface_0x4x0
{

    const TYPE_OPTION_PAGE = 'option';
    const TYPE_METABOX_PAGE = 'metabox';

    /**
     * @var WPDev_Admin_Page_Interface
     */
    protected $adminPage = null;

    /**
     * @var WPDev_Admin_HelpTabs
     */
    protected $helpTabs = null;

    /**
     * @var WPDev_Admin_MetaBoxes
     */
    protected $metaBoxes = null;
    
    /**
     * Constructor
     */
    public function __construct(array $settings, $type = self::TYPE_OPTION_PAGE)
    {
        // create page
        if ($type === self::TYPE_METABOX_PAGE) {
            $this->adminPage = new WPDev_Admin_Page_MetaBox_0x4x0($settings);
        } else {
            $this->adminPage = new WPDev_Admin_Page_Option_0x4x0($settings);
        }

        // get values for help-tabs and meta-boxes
        $templatesBasePath = dirname($settings['pageTemplate']);
        $templateVars = $settings['templateVars'];

        // create meta boxes
        if ($type === self::TYPE_METABOX_PAGE) {
            $this->metaBoxes = new WPDev_Admin_MetaBoxes_0x4x0(array(
                'adminPage'     => $this->adminPage,
                'templatesPath' => $templatesBasePath . '/meta-boxes',
                'templateVars'  => $templateVars,
            ));
        }

        // create help tabs
        $this->helpTabs = new WPDev_Admin_HelpTabs_0x4x0(array(
            'adminPage'     => $this->adminPage,
            'templatesPath' => $templatesBasePath . '/help-tabs',
            'templateVars'  => $templateVars,
        ));
    }

    /**
     *
     * @return string
     */
    public function getHook()
    {
        return $this->adminPage->getHook();
    }

    /**
     * Helper for creating a meta-box
     */
    public function addMetaBox()
    {
        $arguments = func_get_args();
        call_user_func_array(array($this->metaBoxes, 'addMetaBox'), $arguments);
    }

    /**
     * Helper for creating a help-tab
     */
    public function addHelpTab()
    {
        $arguments = func_get_args();
        call_user_func_array(array($this->helpTabs, 'addHelpTab'), $arguments);
    }

}

/*?>*/
