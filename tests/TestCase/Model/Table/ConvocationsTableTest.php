<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConvocationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConvocationsTable Test Case
 */
class ConvocationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConvocationsTable
     */
    public $Convocations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.convocations',
        'app.students',
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
        $config = TableRegistry::getTableLocator()->exists('Convocations') ? [] : ['className' => ConvocationsTable::class];
        $this->Convocations = TableRegistry::getTableLocator()->get('Convocations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Convocations);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
