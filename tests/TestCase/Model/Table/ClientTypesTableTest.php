<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientTypesTable Test Case
 */
class ClientTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientTypesTable
     */
    public $ClientTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.client_types',
        'app.enterprises'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ClientTypes') ? [] : ['className' => ClientTypesTable::class];
        $this->ClientTypes = TableRegistry::getTableLocator()->get('ClientTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientTypes);

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
