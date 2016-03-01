<?php
/**
 * Class WPLim_AdminPage_Page_Abstract
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
abstract class WPLim_AdminPage_Page_Abstract_0x4x0 implements WPLim_AdminPage_Page_Interface_0x4x0
{

    /**
     * Settings
     * @var array
     */
    protected $settings = array(
        'id'            => '',  // = menuSlug
        'title'         => '',  // = page title
        'menuTitle'     => '',
        'capability'    => 'manage_options',
        'function'      => null,
        'iconUrl'       => '',
        'position'      => null,
        'parentSlug'    => 'options-general.php',
        'pageKey'       => 'page',
        'templatesPath'   => '',
        'templateFileExt' => '.php',
        'templateVars'    => array(),
    );

    /**
     * Page hook
     * @var string
     */
    private $hook = null;

    /**
     * Vars passed on to the page template
     * @var array
     */
    protected $templateVars = array();

    /**
     * @var WPLim_Render_Template_Interface_0x4x0
     */
    private $renderTemplate = null;

    
    /**
     * Constructor
     * @param array $settings
     */
    public function __construct(array $settings)
    {
        $this->init();
        $this->setSettings($settings);

        $this->renderTemplate = new WPLim_RenderTemplate_0x4x0(
            $this->settings['templatesPath']
            , $this->settings['templateFileExt']
        );
    }

    /**
     * Initialize
     */
    protected function init()
    {
        // to be implemented by child class
    }

    /**
     * @param array $settings
     */
    final protected function setSettings(array $settings)
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
    }

    /**
     * Create page
     */
    final public function create()
    {
        add_action('admin_menu', function () {
            $this->addPage();
        });
    }

    /**
     * Get the page hook
     * @return string
     */
    final public function getHook()
    {
        return $this->hook;
    }

    /**
     * Create page with menu item
     */
    private function addPage()
    {
        if (empty($this->settings['parentSlug'])) {
        // create main menu
            $this->hook = add_menu_page(
                $this->settings['title']
                , $this->settings['menuTitle']
                , $this->settings['capability']
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
                , $this->settings['capability']
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
        echo $this->renderTemplate->render($this->settings['pageKey'], $this->templateVars);
    }

}

/*?>*/
