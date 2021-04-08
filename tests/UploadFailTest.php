<?php

use Illuminate\Http\UploadedFile;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UploadTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApplication()
    {
        $file = UploadedFile::fake()->create('avatar.pdf');

        $response = $this->post('/', [
            'file' => $file,
        ])->response;

        $response->assertViewIs('home');
        $response->assertViewHasAll(['errors']);
    }
}
