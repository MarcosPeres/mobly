<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Produtos;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testProdutosDatabase()
    {
        $this->assertDatabaseHas('produtos', [
            'id' => 147
        ]);
    }

    public function testPlanilhasDatabase(){
        $this->assertDatabaseHas('planilhas', [
            'id' => 23
        ]);
    }

    public function testProdutosEmptyDatabase(){
        $this->assertDatabaseMissing('produtos', [
            'id' => 888
        ]);
    }

    public function testPlanilhasEmptyDatabase(){
        $this->assertDatabaseMissing('produtos', [
            'id' => 888
        ]);
    }
}
