<?php
/**
 * Class WPLim_Admin_Page_Abstract
 *
 * Creating a normal admin options page
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_Admin_Page_Abstract_0x4x0 implements WPLim_Admin_Page_Interface_0x4x0
{

    /**
     * Settings
     * @var array
     */
    protected $settings = array(
        'id'            => '',  // = menuSlug
        'title'         => '',  // = page title
        'menuTitle'     => '',
        'function'      => null,
        'iconUrl'       => '',
        'position'      => null,
        'parentSlug'    => 'options-general.php',
        'pageTemplate'  => '',
        'templateVars'  => array(),
    );

    /**
     * Vars passed on to the page template
     * @var array
     */
    protected $templateVars = array();

    /**
     * Page hook
     * @var string
     */
    private $hook = null;

    /**
     * Constructor
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->settings = array_merge($this->settings, $settings);

        // default menu title
        if (empty($this->settings['menuTitle'])) {
            $this->settings['menuTitle'] = $this->settings['title'];
        }

        // default callback function
        if (empty($this->settings['function'])) {
            $this->settings['function'] = function () {
                $this->showPage();
            };
        }

        add_action('admin_menu', function () {
            $this->createPage();
        });
    }

    /**
     * Get the page hook
     * @return string
     */
    public function getHook()
    {
        return $this->hook;
    }

    /**
     * Create page with menu item
     */
    protected function createPage()
    {
        if (empty($this->settings['parentSlug'])) {
        // create main menu
            $this->hook = add_menu_page(
                $this->settings['title']
                , $this->settings['menuTitle']
                , 'manage_options'
                , $this->settings['id']
                , $this->settings['function']
                , $this->settings['iconUrl']
            );
        } else {
        // create submenu
            $this->hook = add_submenu_page(
                $this->settings['parentSlug']
                , $this->settings['title']
                , $this->settings['menuTitle']
                , 'manage_options'
                , $this->settings['id']
                , $this->settings['function']
            );
        }

        // load plugin page
        add_action('load-' . $this->hook, function () {
            $this->loadPage();
        });
    }

    /**
     * Load page
     */
    protected function loadPage()
    {
        // show updated message for pages outsite the "Settings" menu
        if (isset($_GET['settings-updated']) && 'options-general.php' !== $this->settings['parentSlug']) {
            $showUpdatedMessage = true;
        } else {
            $showUpdatedMessage = false;
        }

        // prepare templateVars
        $this->templateVars = array_merge($this->settings['templateVars'], array(
            'id' => $this->settings['id'],
            'showUpdatedMessage' => $showUpdatedMessage,
        ));
    }

    /**
     * Show page
     */
    protected function showPage()
    {
        echo $this->renderTemplate();
    }

    /**
     * Render template
     */
    protected function renderTemplate()
    {
        // tight coupling
        $view = new WPLim_View_0x4x0($this->settings['pageTemplate'], $this->templateVars);
        return $view->render();
    }

}

/*?>*/
