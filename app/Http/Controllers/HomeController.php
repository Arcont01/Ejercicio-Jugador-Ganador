<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
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
            $errors = $validate->errors();
            throw new CustomException($errors->first());
        }

        try{
            $file = $request->file('file');
            $content =  file($file);

            $answer = $this->checkRounds($content);

            $rounds = $answer['rounds'];
            $content = $answer['content'];

            $answer = $this->calculateWinnerPlayer($rounds, $content);

            return view('success', $answer);
        }catch(\Throwable $th){
            \Log::error($th);
            throw new CustomException('Un error inesperado a pasado');
        }

    }

    public function checkRounds(array $content){

        foreach ($content as $key => $line) {
            $content[$key] = trim($line);
        }

        $rounds = array_shift($content);

        if(!preg_match('/^[0-9]+$/', $rounds)){
            throw new CustomException('La cantidad de rondas unicamente pueden ser enteros');
        }

        $rounds = (int)$rounds;

        if ($rounds > 10000) {
            throw new CustomException('El numero de rondas no puede ser mayor que 10000');
        }elseif ($rounds == 0) {
            throw new CustomException('No se puede jugar con 0 rondas definidas');
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
            throw new CustomException('El numero de rounds definido es mayor al dado');
        }

        for ($i = 0; $i < $rounds; $i++) {
            $temp = explode(' ', $playersRounds[$i]);

            if(count($temp) != 2){
                throw new CustomException('No pueden ser mas de dos jugadores');
            }

            if(!preg_match('/^[0-9]+$/', $temp[0]) || !preg_match('/^[0-9]+$/', $temp[1])){
                throw new CustomException('Las rondas unicamente pueden tener numeros enteros');
            }

            $firstPlayer = (int) $temp[0];
            $secondPlayer = (int) $temp[1];

            if ($firstPlayer > $secondPlayer) {
                $winnerPlayers[] = 1;
                $tempDifference = $firstPlayer - $secondPlayer;
            } else {
                $winnerPlayers[] = 2;
                $tempDifference = $secondPlayer - $firstPlayer ;
            }

            $differencePoints[] = $tempDifference;
        }

        $max_point = max($differencePoints);
        $indexPoint = array_search($max_point, $differencePoints);
        $winnerPlayer = $winnerPlayers[$indexPoint];

        return ['point' => $max_point, 'winnerPlayer' => $winnerPlayer];
    }
}
