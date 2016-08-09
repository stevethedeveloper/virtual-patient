<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VideosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VideosTable Test Case
 */
class VideosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VideosTable
     */
    public $Videos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.videos',
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
        $config = TableRegistry::exists('Videos') ? [] : ['className' => 'App\Model\Table\VideosTable'];
        $this->Videos = TableRegistry::get('Videos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Videos);

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
