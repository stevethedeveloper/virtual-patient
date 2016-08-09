<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContentBlocksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContentBlocksTable Test Case
 */
class ContentBlocksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContentBlocksTable
     */
    public $ContentBlocks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.content_blocks',
        'app.pages',
        'app.page_types',
        'app.content_pages',
        'app.content_block_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ContentBlocks') ? [] : ['className' => 'App\Model\Table\ContentBlocksTable'];
        $this->ContentBlocks = TableRegistry::get('ContentBlocks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContentBlocks);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
