<?php

namespace App\Http\Controllers;

use App\Models\Judge;
use App\Models\User;
use App\Models\Score;
use Illuminate\Http\Request;

class JudgeController extends Controller
{
    /**
     * Display the judge's dashboard with list of users
     */
    public function index(Judge $judge)
    {
        $users = User::with(['scores' => function($query) use ($judge) {
            $query->where('judge_id', $judge->id);
        }])->get();

        return view('judges.index', compact('judge', 'users'));
    }

    /**
     * Show form to score a user
     */
    public function score(Judge $judge, User $user)
    {
        $existingScore = Score::where('judge_id', $judge->id)
            ->where('user_id', $user->id)
            ->first();

        return view('judges.score', compact('judge', 'user', 'existingScore'));
    }

    /**
     * Store or update a score
     */
    public function storeScore(Request $request, Judge $judge, User $user)
    {
        $validated = $request->validate([
            'points' => 'required|integer|min:1|max:100',
        ]);

        Score::updateOrCreate(
            ['judge_id' => $judge->id, 'user_id' => $user->id],
            ['points' => $validated['points']]
        );

        return redirect()->route('judges.index', $judge)
            ->with('success', 'Score submitted successfully.');
    }
}
