<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\UploadedFile;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PlayersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApplication()
    {
        $homeController = new HomeController();
        $responseCheckRounds = $homeController->checkRounds(['5', '140 82', '89 134', '90 110', '112 106', '88 90']);

        $this->assertArrayHasKey('rounds', $responseCheckRounds);
        $this->assertArrayHasKey('content', $responseCheckRounds);

        $responseCheckRounds = $homeController->calculateWinnerPlayer('5',['140 82', '89 134', '90 110', '112 106', '88 90']);

        $this->assertArrayHasKey('point', $responseCheckRounds);
        $this->assertArrayHasKey('winnerPlayer', $responseCheckRounds);
    }
}
