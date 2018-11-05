<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnterprisesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnterprisesTable Test Case
 */
class EnterprisesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EnterprisesTable
     */
    public $Enterprises;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.enterprises',
        'app.users',
        
        'app.enterprises_missions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Enterprises') ? [] : ['className' => EnterprisesTable::class];
        $this->Enterprises = TableRegistry::getTableLocator()->get('Enterprises', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Enterprises);

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
