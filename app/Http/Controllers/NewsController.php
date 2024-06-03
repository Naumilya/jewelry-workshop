<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        return response($news);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();
        $new = News::create($data);
        return response()->noContent(201)->withHeaders([
            'Location' => route('products.show', [
                'new' => $new->id,
            ]),
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(News $new)
    {
        return response($new);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $new)
    {
        $data = $request->validated();
        $new->update($data);
        return response()->noContent(204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $new)
    {
        $new->delete();
        return response()->noContent(204);
    }
}
