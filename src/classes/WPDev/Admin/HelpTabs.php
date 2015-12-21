<?php
/**
 * Class WPDev_Admin_HelpTabs
 *
 * Creating an admin options page with a menu item
 *
 * @package  WPDev
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPDev
 * @license  MIT license
 */
class WPDev_Admin_HelpTabs_04
{

    /**
     * Settings
     * @var array
     */
    protected $settings = array(
        'adminPage'        => '',      // pageHook name or instanceof WPDev_Admin_Page_Interface
        'templatesPath'   => '',
        'templateVars'    => array(),
        'templateFileExt' => '.php',
        'sidebarKey'      => 'sidebar',
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
     * Constructor
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = array_merge($this->settings, $settings);

        add_action('admin_menu', array($this, 'init'));
    }

    /**
     * Set correct action hook
     */
    public function init()
    {
        $adminPage = $this->settings['adminPage'];

        if ($adminPage === true) {
            $actionName = 'admin_head';
        } elseif ($adminPage instanceof WPDev_Admin_Page_Interface_04) {
            $actionName = 'load-' . $adminPage->getHook();
        } elseif (is_string($adminPage)) {
            $actionName = 'load-' . $adminPage;
        }

        if (isset($actionName)) {
            add_action($actionName, array($this, 'addHelptabs'));
        }
    }

    /**
     * Add help tab
     * @param string $key
     * @param string $title
     */
    public function addHelpTab($key, $title) {
        $this->helpTabs[$key] = array(
            'title' => $title,
        );
    }

    /**
     * Add helpTabs
     * @return void
     */
    public function addHelptabs()
    {
        $screen = get_current_screen();

        // help sidebar
        $sidebarContent = $this->renderTemplate($this->settings['sidebarKey']);

        if ($sidebarContent) {
            $screen->set_help_sidebar($sidebarContent);
        }

        // helpTabs
        foreach ($this->helpTabs as $key => $params) {
            // help tab
            $helpContent = $this->renderTemplate($key);

            $screen->add_help_tab(array(
                'id' => $key,
                'title' => $params['title'],
                'content' => $helpContent,
            ));
        }
    }

    /**
     * Render a template
     * @param string $file
     * @return string
     */
    protected function renderTemplate($key) {
        $templateFile = $this->settings['templatesPath'] . '/' . $key . $this->settings['templateFileExt'];

        $view = WPDev_View_04::create($templateFile, $this->settings['templateVars']);

        if (!$view->exists()) {
            return false;
        }

        return $view->render();
    }

}

/*?>*/
