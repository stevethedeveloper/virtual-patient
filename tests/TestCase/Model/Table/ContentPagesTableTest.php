<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContentPagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContentPagesTable Test Case
 */
class ContentPagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContentPagesTable
     */
    public $ContentPages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.content_pages',
        'app.page_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ContentPages') ? [] : ['className' => 'App\Model\Table\ContentPagesTable'];
        $this->ContentPages = TableRegistry::get('ContentPages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContentPages);

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
