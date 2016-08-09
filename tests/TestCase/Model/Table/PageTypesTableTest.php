<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PageTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PageTypesTable Test Case
 */
class PageTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PageTypesTable
     */
    public $PageTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.page_types',
        'app.content_pages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PageTypes') ? [] : ['className' => 'App\Model\Table\PageTypesTable'];
        $this->PageTypes = TableRegistry::get('PageTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PageTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
