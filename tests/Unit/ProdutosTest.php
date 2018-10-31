<?php

namespace Tests\Feature;

use App\Produtos;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdutosTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testProdutosFind()
    {
        $produtos = \Mockery::mock('Produtos');

        $produtos->shouldReceive('find')->andReturn(['Furadeira X']);

        $this->assertNotEmpty($produtos->find());
    }

    public function testProdutosPostEdit()
    {
        $this->post('produtos/edit', [
            'id' => 147,
            'name' => 'Furadeira X',
            'Im' => '1',
            'Description' => 'Furadeira eficiente X',
            'Price' => '100.00',
            'Category' => '123123'
        ])->assertStatus(200);
    }

    public function testProdutosPostEditStatus()
    {
        $this->post('produtos/edit', [
            'id' => 888,
            'name' => 'Furadeira X',
            'Im' => '1',
            'Description' => 'Furadeira eficiente X',
            'Price' => '100.00',
            'Category' => '123123'
        ])->assertStatus(422);
    }

    public function testProdutosPostDelete()
    {
        $this->delete('produtos/delete', [
            'id' => 151
        ])->assertStatus(200);
    }

    public function testProdutosPostDeleteStatus()
    {
        $this->delete('produtos/delete', [
            'id' => 888
        ])->assertStatus(404);
    }

    public function testProdutosPostList()
    {
        $this->post('produtos/list', [
            'id' => 147
        ])->assertStatus(200);
    }

    public function testProdutosPostListStatus()
    {
        $this->post('produtos/list', [
            'id' => 888
        ])->assertStatus(404);
    }

    public function testProdutosCreate(){

        $produtos = \Mockery::mock('Produtos');

        $produtos->shouldReceive('create')->andReturn(true);

    }

    public function testProdutosIndex()
    {
        $produtos = \Mockery::mock('Produtos');

        $produtos->shouldReceive('index')->andReturn(true);

        $this->assertTrue($produtos->index());
    }

    public function testProdutosMockList()
    {
        $produtos = \Mockery::mock('Produtos');

        $produtos->shouldReceive('list')->andReturn(true);

        $this->assertTrue($produtos->list());
    }

     public function testProdutosMockEdit()
    {
       $produtos = \Mockery::mock('Produtos');

       $produtos->shouldReceive('edit')->andReturn(true);

       $this->assertTrue($produtos->edit());
    }

    public function testProdutosMockDelete()
    {
       $produtos = \Mockery::mock('Produtos');

       $produtos->shouldReceive('delete')->andReturn(true);

       $this->assertTrue($produtos->delete());
    }
}
