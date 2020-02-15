<?php

namespace App\Http\Controllers;

use App\FeedItem;
use App\FeedCategory;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $categoryId = $request->get('category_id', 0);

        $feeds = FeedItem::search([
            'category_id' => $categoryId
        ]);
        $categories = FeedCategory::orderBy('name', 'asc')->get();

        return view('feed.search', [
            'feeds' => $feeds,
            'paging_links' => $feeds->appends(['category_id' => $categoryId])->links(),
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = FeedCategory::orderBy('name', 'asc')->get();
        return view('feed.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id', 1),
            'link' => '',
            'comment' => '',
            'pub_date' => time()
        ];
        $this->validateForm($request);

        FeedItem::create($data);
        $request->session()->flash('successMessage', 'Create new item successfully.');

        return redirect('feed/create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feed = FeedItem::where('id', $id)->first();
        $categories = FeedCategory::orderBy('name', 'asc')->get();

        if (! $feed) {
            throw new Exception("Feed id $id not found");
        }

        return view('feed.edit', [
            'feed' => $feed,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->get('id');
        $feed = FeedItem::where('id', $id)->first();

        if (! $feed) {
            throw new Exception('Page not found');
        }
        $this->validateForm($request);
        $feed->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id')
        ]);
        $request->session()->flash('successMessage', 'Update feed successfully.');

        return redirect('/feed/edit/' . $id);
    }

    /**
     * Validate form input
     * @param \Illuminate\Http\Request $request
     */
    private function validateForm(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:150'
        ]);

        $this->validate($request, [
            'description' => 'required'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FeedItem  $feedItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');

        $feed = FeedItem::where('id', $id)->first();
        if (! $feed) {
            throw new \Exception('Page not found');
        }
        $feed->delete();

        $request->session()->flash('successMessage', 'Delete feed successfully');

        return redirect('/');
    }
}
