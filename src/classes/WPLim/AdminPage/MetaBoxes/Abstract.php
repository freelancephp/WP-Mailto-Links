<?php
/**
 * Class WPLim_AdminPage_MetaBoxes_Abstract
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
abstract class WPLim_AdminPage_MetaBoxes_Abstract_0x4x0 implements WPLim_AdminPage_MetaBoxes_Interface_0x4x0
{

    /**
     * Settings
     * @var array
     */
    protected $settings = array(
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
    private $metaBoxes = array();

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
     * @param string   $key
     * @param string   $title
     * @param string   $context
     * @param string   $priority
     * @param callable $callback
     */
    final public function addMetaBox($key, $title, $context = 'advanced', $priority = 'default', $callback = null) {
        $this->metaBoxes[$key] = array(
            'title' => $title,
            'context' => $context,
            'screen' => $this->settings['screen'],
            'priority' => $priority,
        );

        if ($callback === null) {
            $this->metaBoxes[$key]['callback'] = function ($post, $box) {
                $key = $box['args'][0];
                $this->showMetaBox($key);
            };
        } else {
            $this->metaBoxes[$key]['callback'] = $callback;
        }
    }

    /**
     * Set correct action hook
     */
    protected function setLoadAction()
    {
        $adminPage = $this->adminPage;

        if ($adminPage === null) {
            if (!empty($this->settings['screen'])) {
                // to support 'screen' setting
                $actionName = 'add_meta_boxes';
            }
        } else {
            $actionName = 'load-' . $adminPage->getHook();
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
    private function addMetaBoxes()
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
     */
    private function showMetaBox($key)
    {
        echo $this->renderTemplate->render($key);
    }

}

/*?>*/
