<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PilotsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PilotsTable Test Case
 */
class PilotsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PilotsTable
     */
    public $Pilots;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.pilots',
        'app.users',
        'app.flight_schedules'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Pilots') ? [] : ['className' => PilotsTable::class];
        $this->Pilots = TableRegistry::getTableLocator()->get('Pilots', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pilots);

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
