<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TopicController extends Controller
{
    public function index()
    {
        return Inertia::render('Topic/Topics', [
            'topics'=>Topic::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Topic/TopicCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'image'=>'required'
        ]);
        $image = $request->file('image')->store('topics', 'public');
        Topic::create([
            'title'=>$request->title,
            'image'=>$image
        ]);
        return Redirect::route('topics');
    }

    public function edit(Topic $topic)
    {
        return Inertia::render('Topic/EditTopic', [
            'topic'=>$topic
        ]);
    }

    public function update(Topic $topic, Request $request)
    {
        $request->validate([
            'title'=>'required'
        ]);
        $image = $topic->image;
        if ($request->file('image')) {
            Storage::delete('public/'.$topic->image);
            $image = $request->file('image')->store('topics', 'public');
        }
        $topic->update([
            'title'=>request()->title,
            'image'=>$image
        ]);

        return redirect()->route('topics');
    }

    public function destory(Topic $topic)
    {
        Storage::delete('public/'.$topic->image);
        $topic->delete();
        return Redirect::route('topics');
    }
}
