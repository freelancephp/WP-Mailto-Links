<?php
/**
 * Class WPDev_Admin_MetaBoxes
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
class WPDev_Admin_MetaBoxes_0x4x0
{

    /**
     * Settings
     * @var array
     */
    protected $settings = array(
        'adminPage'        => '',      // pageHook name or instanceof WPDev_Admin_Page_Interface
        'screen'           => null,    // 'post','page','dashboard','link','attachment','custom_post_type','comment'
        'templatesPath'    => '',
        'templateFileExt'  => '.php',
        'templateVars'     => array(),
    );

    /**
     * All metaBoxes
     * @example
     *      array(
     *          'general' => array(
     *             'title'    => __('General Settings'),
     *             'context'  => 'advanced',  // Optional 'normal', 'advanced', or 'side'
     *             'priority' => 'default',   // Optional 'high', 'core', 'default' or 'low'
     *             'callback' => null,        // Optional
     *          ),
     *      );
     * @var array
     */
    protected $metaBoxes = array();

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

        if ($adminPage instanceof WPDev_Admin_Page_Interface_0x4x0) {
            $actionName = 'load-' . $adminPage->getHook();
        } elseif (is_string($adminPage)) {
            $actionName = 'load-' . $adminPage;
        } elseif ($this->settings['screen'] !== null) {
            // to support 'screen' setting
            $actionName = 'admin_head';
        }

        if (isset($actionName)) {
            add_action($actionName, array($this, 'addMetaBoxes'));
        }
    }

    /**
     * Add help tab
     * @param string $key
     * @param string $title
     */
    public function addMetaBox($key, $title, $context = 'advanced', $priority = 'default', $callback = null) {
        $this->metaBoxes[$key] = array(
            'title' => $title,
            'context' => $context,
            'screen' => $this->settings['screen'],
            'priority' => $priority,
        );

        if ($callback === null) {
            $this->metaBoxes[$key]['callback'] = array($this, 'showMetaBox');
        } else {
            $this->metaBoxes[$key]['callback'] = $callback;
        }
    }

    /**
     * Add metaBoxes
     */
    public function addMetaBoxes()
    {
        foreach ($this->metaBoxes as $id => $params) {
            add_meta_box(
                $id
                , $params['title']
                , $params['callback']
                , $params['screen']
                , $params['context']
                , $params['priority']
                , array($id)
            );
        }
    }

    /**
     * Show the content of a metabox
     * @param WP_Post $post
     * @param array $box
     */
    public function showMetaBox($post, $box)
    {
        $id = $box['args'][0];

        $templateFile = $this->settings['templatesPath'] . '/' . $id . $this->settings['templateFileExt'];
        $view = WPDev_View_0x4x0::create($templateFile, $this->settings['templateVars']);

        if ($view->exists()) {
            echo $view->render();
        }
    }

}

/*?>*/
