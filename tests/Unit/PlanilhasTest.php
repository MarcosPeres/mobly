<?php

namespace Tests\Feature;

use App\Planilhas;
use Tests\TestCase;
use App\Events\OrderShipped;
use App\Events\OrderFailedToShip;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlanilhasTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

     public function testPlanilhasIndex()
    {
       $planilhas = \Mockery::mock('Planilhas');

       $planilhas->shouldReceive('index')->andReturn(true);

       $this->assertTrue($planilhas->index());
    }

    public function testPlanilhasCreate(){

        $produtos = \Mockery::mock('Planilhas');

        $produtos->shouldReceive('create')->andReturn(true);

    }

    public function testPlanilhasMockFind()
    {
        $planilhas = \Mockery::mock('Planilhas');

        $planilhas->shouldReceive('find')->andReturn(['products_teste_webdev_lero.xlsx']);

        $this->assertNotEmpty($planilhas->find());
    }

    public function testPlanilhasMockList()
    {
        $planilhas = \Mockery::mock('Produtos');

        $planilhas->shouldReceive('list')->andReturn(true);

        $this->assertTrue($planilhas->list());
    }

    public function testPlanilhasPostList()
    {
        $this->post('planilhas/list', [
            'id' => 23
        ])->assertStatus(200);
    }

    public function testPlanilhasPostListStatus()
    {
        $this->post('planilhas/list', [
            'id' => 888
        ])->assertStatus(404);
    }

    public function testPlanilhasDatabase()
    {

        $this->assertDatabaseHas('planilhas',['name'=>'products_teste_webdev_lero.xlsx']);

    }
}
