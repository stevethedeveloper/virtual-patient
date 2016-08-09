<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContentBlockTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContentBlockTypesTable Test Case
 */
class ContentBlockTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContentBlockTypesTable
     */
    public $ContentBlockTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.content_block_types',
        'app.content_blocks',
        'app.pages',
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
        $config = TableRegistry::exists('ContentBlockTypes') ? [] : ['className' => 'App\Model\Table\ContentBlockTypesTable'];
        $this->ContentBlockTypes = TableRegistry::get('ContentBlockTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContentBlockTypes);

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
