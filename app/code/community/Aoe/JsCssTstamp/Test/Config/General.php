<?php

class Aoe_JsCssTstamp_Test_Config_General extends EcomDev_PHPUnit_Test_Case {

    /**
     * @test
     */
    public function defaultJs() {
        $headBlock = new Mage_Page_Block_Html_Head();
        $headBlock->addJs('prototype/prototype.js');
        $headBlock->addJs('mage/translate.js');

        $html = $headBlock->getCssJsHtml();

        $this->assertContains('prototype/prototype.js', $html);
        $this->assertContains('mage/translate.js', $html);
    }

    /**
     * @loadFixture
     * @test
     */
    public function defaultMergeJs() {
        $headBlock = new Mage_Page_Block_Html_Head();
        $headBlock->addJs('prototype/prototype.js');
        $headBlock->addJs('mage/translate.js');

        $html = $headBlock->getCssJsHtml();

        $this->assertNotContains('prototype/prototype.js', $html);
        $this->assertNotContains('mage/translate.js', $html);
        $this->assertRegExp('/\/[a-f0-9]{32}\.js/', $html);
    }

    /**
     * @loadFixture
     * @test
     */
    public function checkVersionOnUnmergedJsFiles() {

        $this->replaceRegistry(EcomDev_PHPUnit_Model_App::REGISTRY_PATH_DESIGN_PACKAGE_SINGLETON, null);

        $this->assertInstanceOf('Aoe_JsCssTstamp_Model_Package', Mage::getModel('core/design_package'));
        $this->assertInstanceOf('Aoe_JsCssTstamp_Model_Package', Mage::getSingleton('core/design_package'));
        $this->assertInstanceOf('Aoe_JsCssTstamp_Model_Package', Mage::getDesign());

        $this->assertEquals('1', Mage::getStoreConfig('dev/js/addTstampToJsFiles'));

        $headBlock = new Mage_Page_Block_Html_Head();
        $headBlock->addItem('skin_js', 'js/opcheckout.js');

        $html = $headBlock->getCssJsHtml();

        $this->assertNotContains('js/opcheckout.js', $html);
        $this->assertRegExp('/[0-9]{10}\.js/', $html);
        $this->assertRegExp('/js\/opcheckout\.[0-9]{10}\.js/', $html);
    }


    /**
     * @test
     */
    public function defaultCss() {
        $headBlock = new Mage_Page_Block_Html_Head();
        $headBlock->addCss('css/styles.css');

        $html = $headBlock->getCssJsHtml();

        $this->assertContains('css/styles.css', $html);
    }

    /**
     * @loadFixture
     * @test
     */
    public function defaultMergeCss() {
        $headBlock = new Mage_Page_Block_Html_Head();
        $headBlock->addCss('css/styles.css');

        $html = $headBlock->getCssJsHtml();

        $this->assertNotContains('css/styles.css', $html);
        $this->assertRegExp('/\/[a-f0-9]{32}\.css/', $html);
    }

    /**
     * @loadFixture
     * @test
     */
    public function checkVersionOnUnmergedCssFiles() {

        $this->replaceRegistry(EcomDev_PHPUnit_Model_App::REGISTRY_PATH_DESIGN_PACKAGE_SINGLETON, null);

        $this->assertInstanceOf('Aoe_JsCssTstamp_Model_Package', Mage::getModel('core/design_package'));
        $this->assertInstanceOf('Aoe_JsCssTstamp_Model_Package', Mage::getSingleton('core/design_package'));
        $this->assertInstanceOf('Aoe_JsCssTstamp_Model_Package', Mage::getDesign());

        $this->assertEquals('1', Mage::getStoreConfig('dev/css/addTstampToCssFiles'));

        $headBlock = new Mage_Page_Block_Html_Head();
        $headBlock->addCss('css/styles.css');

        $html = $headBlock->getCssJsHtml();

        $this->assertNotContains('css/styles.css', $html);
        $this->assertRegExp('/[0-9]{10}\.css/', $html);
        $this->assertRegExp('/css\/styles\.[0-9]{10}\.css/', $html);
    }

}