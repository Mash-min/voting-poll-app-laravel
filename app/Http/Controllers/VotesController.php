<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Poll;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function create(Request $request)
    {   
        Poll::findOrFail($request->poll_id)->votes()
                                           ->where('user_id', $request->user()->id)
                                           ->where('poll_id', $request->poll_id)
                                           ->delete();
        $vote =  $request->user()->votes()->create($request->all());
        $poll = Poll::with('items.votes')->findOrFail($request->poll_id);
        return response()->json([
            'message' => 'Vote added', 
            'vote' => $vote,
            'poll' => $poll
        ]);
    }

    public function update(Request $request, $id)
    {
        $vote = $request->user()->votes()->findOrFail($id);
        $vote->update($request->all());
    }
}
