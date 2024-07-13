<?php

namespace App\Http\Controllers\EventOrganizer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('event_organizer.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event_organizer.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'required',
            'description' => 'required'
        ]);

        Category::create($request->all());

        flash()->flash('success', 'Kategori <b>'. $request->name .'</b> berhasil dibuat.');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('event_organizer.category.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('event_organizer.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'required',
            'description' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        flash()->flash('success', 'Kategori <b>'. $category->name  . '</b> berhasil diperbarui.');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        flash()->flash('success', 'Kategori <b>'. $category->name  . '</b> berhasil dihapus.');
        return redirect()->route('category.index');
    }
}
