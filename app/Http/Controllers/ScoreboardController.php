<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class ScoreboardController extends Controller
{
    /**
     * Display the scoreboard
     */
    public function index()
    {
        $users = $this->getOrderedUsers();
        return view('scoreboard.index', compact('users'));
    }

    /**
     * Get scoreboard data for HTMX updates
     */
    public function getData()
    {
        $users = $this->getOrderedUsers();
        return view('scoreboard.partials.scores', compact('users'));
    }

    /**
     * Get users ordered by their total score
     */
    private function getOrderedUsers()
    {
        return User::select('users.*')
            ->selectRaw('COALESCE(SUM(scores.points), 0) as total_score')
            ->leftJoin('scores', 'users.id', '=', 'scores.user_id')
            ->groupBy('users.id')
            ->orderByDesc('total_score')
            ->get();
    }
}
