<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UploadTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUploadStatus()
    {

        $file = UploadedFile::fake()->create('document.xlsx');

        $response = $this->json('POST', '/upload', [
            'arquivo' => $file,
        ]);

        $response->assertStatus(500);

    }

    public function testUploadExtension()
    {

        $file = UploadedFile::fake()->create('document.pdf', 20);

        $response = $this->json('POST', '/upload', [
            'arquivo' => $file,
        ]);

        $response->assertStatus(415);

    }

}
