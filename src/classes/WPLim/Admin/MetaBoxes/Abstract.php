<?php
/**
 * Class WPLim_Admin_MetaBoxes_Abstract
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
abstract class WPLim_Admin_MetaBoxes_Abstract_0x4x0 implements WPLim_Admin_MetaBoxes_Interface_0x4x0
{

    /**
     * Settings
     * @var array
     */
    protected $settings = array(
        'adminPage'        => '',      // pageHook name or instanceof WPLim_Admin_Page_Interface
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

        add_action('admin_menu', function () {
            $this->init();
        });
    }

    /**
     * Add help tab
     * @param string   $key
     * @param string   $title
     * @param string   $context
     * @param string   $priority
     * @param callable $callback
     */
    public function addMetaBox($key, $title, $context = 'advanced', $priority = 'default', $callback = null) {
        $this->metaBoxes[$key] = array(
            'title' => $title,
            'context' => $context,
            'screen' => $this->settings['screen'],
            'priority' => $priority,
        );

        if ($callback === null) {
            $this->metaBoxes[$key]['callback'] = function ($post, $box) {
                $this->showMetaBox($post, $box);
            };
        } else {
            $this->metaBoxes[$key]['callback'] = $callback;
        }
    }

    /**
     * Set correct action hook
     */
    protected function init()
    {
        $adminPage = $this->settings['adminPage'];

        if ($adminPage instanceof WPLim_Admin_Page_Interface_0x4x0) {
            $actionName = 'load-' . $adminPage->getHook();
        } elseif (is_string($adminPage)) {
            $actionName = 'load-' . $adminPage;
        } elseif ($this->settings['screen'] !== null) {
            // to support 'screen' setting
            $actionName = 'admin_head';
        }

        if (isset($actionName)) {
            add_action($actionName, function () {
                $this->addMetaBoxes();
            });
        }
    }

    /**
     * Add metaBoxes
     */
    protected function addMetaBoxes()
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
    protected function showMetaBox($post, $box)
    {
        $id = $box['args'][0];
        $templateFile = $this->settings['templatesPath'] . '/' . $id . $this->settings['templateFileExt'];

        // tight coupling
        $renderer = new WPLim_Template_Render_0x4x0();
        echo $renderer->render($templateFile, $this->settings['templateVars']);
    }

}

/*?>*/
