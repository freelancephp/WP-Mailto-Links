<?php
/**
 * Class WPLim_AdminPage_HelpTabs_Abstract
 *
 * Creating an admin options page with a menu item
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_AdminPage_HelpTabs_Abstract_0x4x0 implements WPLim_AdminPage_HelpTabs_Interface_0x4x0
{

    const ALL_ADMIN_PAGES = null;

    /**
     * Settings
     * @var array
     */
    protected $settings = array(
        'sidebarKey'      => 'sidebar',
        'templatesPath'   => '',
        'templateFileExt' => '.php',
        'templateVars'    => array(),
    );

    /**
     * All helpTabs
     * @example
     *      array(
     *          'main' => array(
     *              'title' => 'Uitleg',
     *           ),
     *      );
     * @var array
     */
    protected $helpTabs = array();

    /**
     * @var WPLim_AdminPage_Page_Interface_0x4x0
     */
    protected $adminPage = null;

    /**
     * @var WPLim_Render_Template_Interface_0x4x0
     */
    protected $renderTemplate = null;

    
    /**
     * Constructor
     * @param array $settings
     */
    final public function __construct(WPLim_AdminPage_Page_Interface_0x4x0 $adminPage = null, array $settings = array())
    {
        $this->adminPage = $adminPage;
        $this->settings = array_merge($this->settings, $settings);

        $this->renderTemplate = new WPLim_RenderTemplate_0x4x0(
            $this->settings['templatesPath']
            , $this->settings['templateFileExt']
            , $this->settings['templateVars']
        );

        add_action('admin_menu', function () {
            $this->setLoadAction();
        });
    }

    /**
     * Add help tab
     * @param string $key
     * @param string $title
     */
    final public function addHelpTab($key, $title) {
        $this->helpTabs[$key] = array(
            'title' => $title,
        );
    }

    /**
     * Set correct action hook
     */
    protected function setLoadAction()
    {
        $adminPage = $this->adminPage;

        if ($adminPage === self::ALL_ADMIN_PAGES) {
            $actionName = 'admin_head';
        } else {
            $actionName = 'load-' . $adminPage->getHook();
        }

        add_action($actionName, function () {
            $this->addHelptabs();
        });
    }

    /**
     * Add helpTabs
     * @return void
     */
    private function addHelptabs()
    {
        $screen = get_current_screen();

        // help sidebar
        if ($this->renderTemplate->exists($this->settings['sidebarKey'])) {
            $sidebarContent = $this->renderTemplate->render($this->settings['sidebarKey']);
            $screen->set_help_sidebar($sidebarContent);
        }

        // helpTabs
        foreach ($this->helpTabs as $key => $params) {
            // help tab
            $helpContent = $this->renderTemplate->render($key);

            $screen->add_help_tab(array(
                'id' => $key,
                'title' => $params['title'],
                'content' => $helpContent,
            ));
        }
    }

}

/*?>*/
