<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsApiController extends Controller
{
public function index()
{
$news = News::all();
return response()->json(['news' => $news]);
}

public function show($id)
{
$news = News::findOrFail($id);
return response()->json(['news' => $news]);
}

public function store(Request $request)
{
$validatedData = $request->validate([
'title' => 'required',
'content' => 'required',
'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
]);

if ($request->hasFile('image')) {
$imagePath = $request->file('image')->store('news_images', 'public');
$validatedData['image'] = $imagePath;
}

$news = News::create($validatedData);

return response()->json(['message' => 'News created successfully', 'news' => $news]);
}

public function update(Request $request, $id)
{
$news = News::findOrFail($id);

$validatedData = $request->validate([
'title' => 'required',
'content' => 'required',
'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
]);

if ($request->hasFile('image')) {
$imagePath = $request->file('image')->store('news_images', 'public');
$validatedData['image'] = $imagePath;

// Delete old image if it exists
if ($news->image) {
Storage::disk('public')->delete($news->image);
}
}

$news->update($validatedData);

return response()->json(['message' => 'News updated successfully', 'news' => $news]);
}

public function destroy($id)
{
$news = News::findOrFail($id);

if ($news->image) {
Storage::disk('public')->delete($news->image);
}

$news->delete();

return response()->json(['message' => 'News deleted successfully']);
}
}