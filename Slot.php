<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Slot extends Command
{

    protected $signature = 'slots:play';

    protected $description = 'Slots game turn and its result';

    public function __construct() { parent::__construct(); }

    public function handle()
    {
        $bet_amount = 100;
        $symbols = [
            '9',
            '10',
            'j',
            'q',
            'k',
            'a',
            'cat',
            'dog',
            'monkey',
            'bird',
        ];
        $max_symbol = count($symbols)-1; // max index of available symbol, for generation
        $paylines = [
            [0,3,6,9,12],
            [1,4,7,10,13],
            [2,5,8,11,14],
            [0,4,8,10,12],
            [2,4,6,10,14],
        ];
        $match_and_return = [ // matched consecutive symbols count and return coeficient
            3 => 0.2,
            4 => 2,
            5 => 10,
        ];
        $min_match = min(array_keys($match_and_return)); // minimum consecutive matched symbols count as value
        $board_size = 15; // as 5x3 :)
        $board = [];
        for ($board_cell = 0; $board_cell < $board_size; $board_cell++) {
            $symbol = random_int(0, $max_symbol);
            $board[] = $symbols[$symbol];
        }
        $result = [
            'board' => $board,
            'paylines' => [],
            'bet_amount' => $bet_amount,
            'total_win' => 0
        ];
        foreach ($paylines as $payline) {
            $prev_symbol = null;
            $consecutive = 1;
            foreach ($payline as $board_cell_nr) {
                $payline_symbol = $board[$board_cell_nr];
                ($payline_symbol === $prev_symbol) ? $consecutive++ : $consecutive = 1;
                $prev_symbol = $payline_symbol;
            }
            if ($consecutive >= $min_match) {
                $result['paylines'][] = [
                    implode(' ', $payline) => $consecutive,
                ];
                $result['total_win'] += $match_and_return[$consecutive] * $bet_amount;
            }
        }
        $this->info(json_encode($result));
    }

}
