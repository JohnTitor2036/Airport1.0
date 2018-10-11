<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HangarsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HangarsTable Test Case
 */
class HangarsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HangarsTable
     */
    public $Hangars;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.hangars',
        'app.users',
        'app.aircrafts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Hangars') ? [] : ['className' => HangarsTable::class];
        $this->Hangars = TableRegistry::getTableLocator()->get('Hangars', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Hangars);

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
