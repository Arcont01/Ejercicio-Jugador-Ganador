<?php

use Illuminate\Http\UploadedFile;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UploadFailTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApplication()
    {
        $file = UploadedFile::fake()->create('prueba.pdf');

        $response = $this->post('/', [
            'file' => $file,
        ])->response;

        $response->assertViewIs('home');
        $response->assertViewHasAll(['errors']);
    }
}
