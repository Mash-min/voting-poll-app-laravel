<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;

class PollsController extends Controller
{

    public function create(Request $request)
    {
        $poll = $request->user()->polls()->create($request->all());
        return response()->json(['message' => 'Poll added', 'poll' => $poll]);
    }

    public function delete(Request $request, $id)
    {
        $request->user()->polls()->findOrFail($id)->delete();
        return response()->json(['message' => 'Poll deleted']);
    }

    public function update(Request $request, $id)
    {
        $poll =  $request->user()->polls()->findOrFail($id);
        $poll->update($request->all());
        return response()->json(['message' => 'Poll updated', 'poll' => $poll]);
    }

    public function find(Request $request, $id)
    {
        $poll = $request->user()->polls()->with('items.votes')->findOrFail($id);
        return response()->json(['poll' => $poll]);
    }

    public function polls()
    {
        $polls = Poll::orderBy('created_at', 'DESC')->with('items.votes')->with('user')->paginate(5);
        return response()->json(['polls' => $polls]);
    }

    public function search($data)
    {
        $polls = Poll::where('title', 'like', '%'.$data.'%')
                     ->orderBy('created_at', 'DESC')
                     ->with('items.votes')
                     ->paginate(5);
        return response()->json(['polls' => $polls]);
    }

}
