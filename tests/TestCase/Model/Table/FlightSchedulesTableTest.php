<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FlightSchedulesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FlightSchedulesTable Test Case
 */
class FlightSchedulesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FlightSchedulesTable
     */
    public $FlightSchedules;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.flight_schedules',
        'app.users',
        'app.aircrafts',
        'app.pilots'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FlightSchedules') ? [] : ['className' => FlightSchedulesTable::class];
        $this->FlightSchedules = TableRegistry::getTableLocator()->get('FlightSchedules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FlightSchedules);

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
