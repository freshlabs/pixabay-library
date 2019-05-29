<?php

/*
 * This file is part of the pixabay-library package.
 *
 * (c) 2019 WEBEWEB
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\Pixabay\Tests\Model;

use WBW\Library\Pixabay\Tests\AbstractTestCase;
use WBW\Library\Pixabay\Tests\Fixtures\Model\TestRequest;

/**
 * Abstract request test.
 *
 * @author webeweb <https://github.com/webeweb/>
 * @package WBW\Library\Pixabay\Tests\Model
 */
class AbstractRequestTest extends AbstractTestCase {

    /**
     * Tests the __construct() method.
     *
     * @return void
     */
    public function testConstruct() {

        $obj = new TestRequest();

        $this->assertNull($obj->getCategory());
        $this->assertNull($obj->getEditorChoice());
        $this->assertNull($obj->getId());
        $this->assertNull($obj->getLang());
        $this->assertNull($obj->getMinHeight());
        $this->assertNull($obj->getMinWidth());
        $this->assertNull($obj->getOrder());
        $this->assertNull($obj->getPage());
        $this->assertNull($obj->getPerPage());
        $this->assertNull($obj->getPretty());
        $this->assertNull($obj->getQ());
        $this->assertNull($obj->getSafeSearch());
    }

    /**
     * Tests the setCategory() method.
     *
     * @return void
     */
    public function testSetCategory() {

        $obj = new TestRequest();

        $obj->setCategory("category");
        $this->assertEquals("category", $obj->getCategory());
    }

    /**
     * Tests the setEditorChoice() method.
     *
     * @return void
     */
    public function testSetEditorChoice() {

        $obj = new TestRequest();

        $obj->setEditorChoice(true);
        $this->assertTrue($obj->getEditorChoice());
    }

    /**
     * Tests the setId() method.
     *
     * @return void
     */
    public function testSetId() {

        $obj = new TestRequest();

        $obj->setId("id");
        $this->assertEquals("id", $obj->getId());
    }

    /**
     * Tests the setLang() method.
     *
     * @return void
     */
    public function testSetLang() {

        $obj = new TestRequest();

        $obj->setLang("lang");
        $this->assertEquals("lang", $obj->getLang());
    }

    /**
     * Tests the setMinHeight() method.
     *
     * @return void
     */
    public function testSetMinHeight() {

        $obj = new TestRequest();

        $obj->setMinHeight("minHeight");
        $this->assertEquals("minHeight", $obj->getMinHeight());
    }

    /**
     * Tests the setMinWidth() method.
     *
     * @return void
     */
    public function testSetMinWidth() {

        $obj = new TestRequest();

        $obj->setMinWidth("minWidth");
        $this->assertEquals("minWidth", $obj->getMinWidth());
    }

    /**
     * Tests the setOrder() method.
     *
     * @return void
     */
    public function testSetOrder() {

        $obj = new TestRequest();

        $obj->setOrder("order");
        $this->assertEquals("order", $obj->getOrder());
    }

    /**
     * Tests the setPage() method.
     *
     * @return void
     */
    public function testSetPage() {

        $obj = new TestRequest();

        $obj->setPage(1);
        $this->assertEquals(1, $obj->getPage());
    }

    /**
     * Tests the setPerPage() method.
     *
     * @return void
     */
    public function testSetPerPage() {

        $obj = new TestRequest();

        $obj->setPerPage(20);
        $this->assertEquals(20, $obj->getPerPage());
    }

    /**
     * Tests the setPretty() method.
     *
     * @return void
     */
    public function testSetPretty() {

        $obj = new TestRequest();

        $obj->setPretty(true);
        $this->assertTrue($obj->getPretty());
    }

    /**
     * Tests the setQ() method.
     *
     * @return void
     */
    public function testSetQ() {

        $obj = new TestRequest();

        $obj->setQ("query");
        $this->assertEquals("query", $obj->getQ());
    }

    /**
     * Tests the setSafeSearch() method.
     *
     * @return void
     */
    public function testSetSafeSearch() {

        $obj = new TestRequest();

        $obj->setSafeSearch(true);
        $this->assertTrue($obj->getSafeSearch());
    }
}