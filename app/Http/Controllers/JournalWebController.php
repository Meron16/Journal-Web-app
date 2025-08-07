<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JournalWebController extends Controller
{
    public function index()
    {
        $journals = Journal::with('user')->latest()->get();
        return view('journals.index', compact('journals'));
    }

    public function create()
    {
        return view('journals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('journals', 'public');
        }

        Journal::create($data);

        return redirect()->route('journals.index')->with('success', 'Journal created successfully.');
    }

    public function show($id)
    {
        $journal = Journal::with('user')->findOrFail($id);
        return view('journals.show', compact('journal'));
    }

    public function edit($id)
    {
        $journal = Journal::findOrFail($id);

        if ($journal->user_id !== auth()->id()) {
            abort(403);
        }

        return view('journals.edit', compact('journal'));
    }

    public function update(Request $request, $id)
    {
        $journal = Journal::findOrFail($id);

        if ($journal->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $journal->title = $request->title;
        $journal->body = $request->body;

        if ($request->hasFile('image')) {
            if ($journal->image) {
                Storage::disk('public')->delete($journal->image);
            }
            $journal->image = $request->file('image')->store('journals', 'public');
        }

        $journal->save();

        return redirect()->route('journals.index')->with('success', 'Journal updated successfully.');
    }

    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);

        if ($journal->user_id !== auth()->id()) {
            abort(403);
        }

        if ($journal->image) {
            Storage::disk('public')->delete($journal->image);
        }

        $journal->delete();

        return redirect()->route('journals.index')->with('success', 'Journal deleted successfully.');
    }
}
