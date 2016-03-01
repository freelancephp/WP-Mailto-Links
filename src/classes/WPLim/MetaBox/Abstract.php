<?php
/**
 * Class WPLim_MetaBox_Abstract
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_MetaBox_Abstract_0x4x0
{

    /**
     * Settings
     * @var array
     */
    protected $settings = array(
        'key'    => '',
        'title'    => '',
        'screen'    => '',
        '$context'    => 'advanced',
        '$priority'    => 'default',
        '$context'    => '$context',
        '$callback'    => null,
        '$callback'    => null,
        'templateFileExt'  => '.php',
        'templateVars'     => array(),
    );

    /**
     * @var string|array
     */
    private $screen = null;

    /**
     * @var WPLim_Render_Template_Interface_0x4x0
     */
    private $renderTemplate = null;

    /**
     * Constructor
     * @param string|array $screen  'post','page','dashboard','link','attachment','custom_post_type','comment'
     * @param array        $settings
     */
    final public function __construct($key, $title, $screen, $context = 'advanced', $priority = 'default', $callback = null, array $settings = array())
    {
        $this->screen = $screen;

        if ($callback === null) {
            $this->callback = function (/*$post, $box*/) {
                $this->showMetaBox();
            };
        } else {
            $this->callback = $callback;
        }

        $this->settings = array_merge($this->settings, $settings);

        $this->renderTemplate = new WPLim_RenderTemplate_0x4x0(
            $this->settings['templatesPath']
            , $this->settings['templateFileExt']
            , $this->settings['templateVars']
        );

        add_action('add_meta_boxes', function () {
            $this->addMetaBox();
        });
    }

    /**
     * Add metaBoxes
     */
    private function addMetaBox()
    {
        add_meta_box(
            $this->id
            , $this->title
            , $this->callback
            , $this->screen
            , $this->context
            , $this->priority
            , array($this->id)
        );
    }

    /**
     * Show metabox content
     */
    private function showMetaBox()
    {
        echo $this->renderTemplate->render();
    }

}

/*?>*/
