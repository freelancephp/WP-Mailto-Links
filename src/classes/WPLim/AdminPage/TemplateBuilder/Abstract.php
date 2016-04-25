<?php
/**
 * Class WPLim_AdminPage_TemplateBuilder_Abstract
 *
 * @package  WPLim
 * @category WordPress Library
 * @version  0.4.0
 * @author   Victor Villaverde Laan
 * @link     http://www.freelancephp.net/
 * @link     https://github.com/freelancephp/WPLim
 * @license  MIT license
 */
abstract class WPLim_AdminPage_TemplateBuilder_Abstract_0x4x0 implements WPLim_AdminPage_TemplateBuilder_Interface_0x4x0
{

    /**
     * @var WPLim_AdminPage_Interface
     */
    private $adminPage = null;

    /**
     * @var WPLim_Admin_HelpTabs_Interface
     */
    private $helpTabs = null;

    /**
     * @var WPLim_Admin_MetaBoxes_Interface
     */
    private $metaBoxes = null;

    /**
     * @var WPLim_Option_Interface_0x4x0
     */
    private $option = null;

    /**
     * @var WPLim_Fields_Decorator_View_Interface_0x4x0
     */
    private $fieldsView = null;

    /**
     * @var string
     */
    private $templateBasePath = null;


    /**
     * Built page (template method)
     */
    final public function built()
    {
        $this->before();

        $this->prepareOption();

        $this->prepareAdminPage();
        $this->createAdminPage();

        $this->prepareHelpTabs();
        $this->prepareMetaBoxes();

        $this->setEnqueueScripts();

        $this->after();
    }

    /**
     * Before procedure
     * Optionally implemented by subclass
     */
    protected function before()
    {
    }

    /**
     * Set option(s)
     * Optionally implemented by subclass
     */
    protected function prepareOption()
    {
    }

    /**
     * Set admin page
     */
    abstract protected function prepareAdminPage();

    /**
     * Set helptabs
     * Optionally implemented by subclass
     */
    protected function prepareHelpTabs()
    {
    }

    /**
     * Set metaboxes
     * Optionally implemented by subclass
     */
    protected function prepareMetaBoxes()
    {
    }

    /**
     * Set scripts
     * Optionally implemented by subclass
     */
    protected function enqueueScripts()
    {
    }

    /**
     * After procedure
     * Optionally implemented by subclass
     */
    protected function after()
    {
    }

    /**
     * Set callback for enqueue scripts
     */
    private function setEnqueueScripts()
    {
        add_action('admin_enqueue_scripts', function ($hook) {
            if ($hook !== $this->adminPage->getHook()) {
                return;
            }

            $this->enqueueScripts();
        });
    }

    /**
     * Call create admin page
     */
    private function createAdminPage()
    {
        if ($this->adminPage !== null) {
            $this->adminPage->create();
        }
    }

    /**
     * @param WPLim_Option_Interface_0x4x0 $option
     */
//    final protected function setOption($option, $fieldsViewClass = 'WPLim_Fields_Decorator_View_0x4x0')
//    {
//        $this->option = $option;
//
//        // create fieldsView
//        if (class_exists($fieldsViewClass)) {
//            $fieldsView = new $fieldsViewClass($option);
//            $this->fieldsView = $fieldsView;
//        }
//    }
    final protected function setOption($option)
    {
        $this->option = $option;
    }

    final protected function setFieldsView($fieldsView)
    {
        $this->fieldsView = $fieldsView;
    }

    /**
     * @return WPLim_Option_Interface_0x4x0
     */
    final protected function getOption()
    {
        return $this->option;
    }

    /**
     * @return WPLim_Fields_Decorator_View_Interface_0x4x0
     */
    final protected function getFieldsView()
    {
        return $this->fieldsView;
    }

    /**
     * @param WPLim_AdminPage_Page_Interface_0x4x0 $adminPage
     */
    final protected function setAdminPage(WPLim_AdminPage_Page_Interface_0x4x0 $adminPage)
    {
        $this->adminPage = $adminPage;
    }

    /**
     * @return WPLim_AdminPage_Page_Interface_0x4x0
     */
    final protected function getAdminPage()
    {
        return $this->adminPage;
    }

    /**
     * @param WPLim_AdminPage_HelpTabs_Interface_0x4x0 $helpTabs
     */
    final protected function setHelpTabs(WPLim_AdminPage_HelpTabs_Interface_0x4x0 $helpTabs)
    {
        $this->helpTabs = $helpTabs;
    }

    /**
     * @return WPLim_AdminPage_HelpTabs_Interface_0x4x0
     */
    final protected function getHelpTabs()
    {
        return $this->helpTabs;
    }

    /**
     * @param WPLim_AdminPage_MetaBoxes_Interface_0x4x0 $metaBoxes
     */
    final protected function setMetaBoxes(WPLim_AdminPage_MetaBoxes_Interface_0x4x0 $metaBoxes)
    {
        $this->metaBoxes = $metaBoxes;
    }

    /**
     * @return WPLim_AdminPage_MetaBoxes_Interface_0x4x0
     */
    final protected function getMetaBoxes()
    {
        return $this->metaBoxes;
    }

    /**
     * @param string $templateBasePath
     */
    final protected function setTemplateBasePath($templateBasePath)
    {
        $this->templateBasePath = $templateBasePath;
    }

    /**
     * @return string
     */
    final protected function getTemplateBasePath()
    {
        return $this->templateBasePath;
    }

}

/*?>*/
