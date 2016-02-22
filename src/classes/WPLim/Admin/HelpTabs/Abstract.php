<?php
/**
 * Class WPLim_Admin_HelpTabs_Abstract
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
abstract class WPLim_Admin_HelpTabs_Abstract_0x4x0 implements WPLim_Admin_HelpTabs_Interface_0x4x0
{

    /**
     * Settings
     * @var array
     */
    protected $settings = array(
        'adminPage'        => '',      // pageHook name or instanceof WPLim_Admin_Page_Interface
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
     * Constructor
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = array_merge($this->settings, $settings);

        add_action('admin_menu', function () {
            $this->init();
        });
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
     * Set correct action hook
     */
    protected function init()
    {
        $adminPage = $this->settings['adminPage'];

        if ($adminPage === true) {
            $actionName = 'admin_head';
        } elseif ($adminPage instanceof WPLim_Admin_Page_Interface_0x4x0) {
            $actionName = 'load-' . $adminPage->getHook();
        } elseif (is_string($adminPage)) {
            $actionName = 'load-' . $adminPage;
        }

        if (isset($actionName)) {
            add_action($actionName, function () {
                $this->addHelptabs();
            });
        }
    }

    /**
     * Add helpTabs
     * @return void
     */
    protected function addHelptabs()
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

        // tight coupling
        $renderer = new WPLim_Template_Render_0x4x0();
        return $renderer->render($templateFile, $this->settings['templateVars']);
    }

}

/*?>*/
