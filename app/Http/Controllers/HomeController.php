<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'file' => ['required', 'file', 'mimes:txt']
        ]);

        if ($validate->fails()) {
            $data['errors'] = $validate->errors();
            return view('home', $data);
        }

        $file = $request->file('file');
        $content =  file($file);

        $answer = $this->checkRounds($content);

        if(array_key_exists('error', $answer)){
            $answer['error_requirements'] = $answer['error'];
            return view('home', $answer);
        }

        $rounds = $answer['rounds'];
        $content = $answer['content'];

        $answer = $this->calculateWinnerPlayer($rounds, $content);

        if(array_key_exists('error', $answer)){
            $answer['error_requirements'] = $answer['error'];
            return view('home', $answer);
        }

        return view('success', $answer);

    }

    public function checkRounds(array $content){

        foreach ($content as $key => $line) {
            $content[$key] = trim($line);
        }
        $rounds = (int)array_shift($content);

        if ($rounds > 10000) {
           return ['error' => 'El numero de rondas no puede ser mayor que 10000'];
        }

        return ['rounds' => $rounds, 'content' => $content];
    }

    /**
     *
     * Function to calculate winner player
     */
    public function calculateWinnerPlayer(int $rounds, array $playersRounds)
    {
        $winnerPlayers = [];
        $differencePoints = [];

        if($rounds > count($playersRounds)){
            return ['error' => 'El numero de rounds definido es mayor al dado'];
        }

        for ($i = 0; $i < $rounds; $i++) {
            $temp = explode(' ', $playersRounds[$i]);

            if(count($temp) != 2){
                return ['error' => 'Deben de ser unicamente dos jugadores'];
            }

            $firstPlayer = (int) $temp[0];
            $secondPlayer = (int) $temp[1];
            if ($firstPlayer > $secondPlayer) {
                $winnerPlayers[] = 1;
            } else {
                $winnerPlayers[] = 2;
            }

            $tempDifference = $firstPlayer - $secondPlayer;
            $differencePoints[] = $tempDifference =  abs($tempDifference);
        }

        $max_point = max($differencePoints);
        $indexPoint = array_search($max_point, $differencePoints);
        $winnerPlayer = $winnerPlayers[$indexPoint];

        return ['point' => $max_point, 'winnerPlayer' => $winnerPlayer];
    }
}
