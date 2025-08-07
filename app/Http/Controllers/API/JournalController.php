<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JournalController extends Controller
{
    public function index()
    {
        return response()->json(Journal::with('user')->latest()->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'user_id' => $request->user()->id,
            'title'   => $request->title,
            'body'    => $request->body,
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('journals', 'public');
            $data['image'] = $path;
        }

        $journal = Journal::create($data);

        return response()->json($journal, 201);
    }

    public function show($id)
    {
        $journal = Journal::with('user')->find($id);
        if (!$journal) return response()->json(['message' => 'Not found'], 404);

        return response()->json($journal);
    }

    public function update(Request $request, $id)
    {
        $journal = Journal::find($id);
        if (!$journal) return response()->json(['message' => 'Not found'], 404);

        if ($journal->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'body'  => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('journals', 'public');
            $journal->image = $path;
        }

        $journal->update($request->only('title', 'body'));

        return response()->json($journal);
    }

    public function destroy($id)
    {
        $journal = Journal::find($id);
        if (!$journal) return response()->json(['message' => 'Not found'], 404);

        if ($journal->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $journal->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
