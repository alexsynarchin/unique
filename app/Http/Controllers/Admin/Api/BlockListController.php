<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\BlockList;
use Illuminate\Http\Request;

class BlockListController extends Controller
{
    public function index(Request $request)
    {
        $block_lists = BlockList::where('type', $request->get('type'))

            ->orderBy('created_at','desc')->get();
        return $block_lists;
    }

    public function store(Request $request)
    {

        $block_list = BlockList::create($request->all());
        return $block_list;
    }

    public function updateTitle(Request $request, $id)
    {
        $block_list = BlockList::findOrFail($id);
        $block_list->update($request->all());
        return [
            'title' => $block_list->title,
            'options' => $block_list->options
        ];
    }

    public function storeItem(Request $request, $id)
    {
        $block_list = BlockList::findOrFail($id);
        $list = $block_list->list;
        $blocks = $request->all();

        if(array_key_exists('image', $blocks)) {
            if(array_key_exists('imageName', $blocks['image'])) {
                $image = $block_list ->addMediaFromBase64($blocks['image']['link'])
                    ->usingFileName($blocks['image']['imageName'])
                    ->toMediaCollection('pages');
                $blocks['image']['link'] = $image->getUrl();
                $blocks['image']['id'] = $image -> id;
                unset($blocks['image']['imageName']);
            }
        }

       array_push($list, $blocks);
        $block_list->list = $list;
        $block_list->save();
        return $blocks;

    }

    public function updateItem(Request $request, $id)
    {
        $block_list = BlockList::findOrFail($id);
        $list = $block_list->list;
        $blocks = $request->except('index');
        if(array_key_exists('image', $blocks)){
            if(array_key_exists('imageName', $blocks['image'])) {
                $image = $block_list ->addMediaFromBase64($blocks['image']['link'])
                    ->usingFileName($blocks['image']['imageName'])
                    ->toMediaCollection('pages');
                $blocks['image']['link'] = $image->getUrl();
                $blocks['image']['id'] = $image -> id;
                unset($blocks['image']['imageName']);
            }
        }

        $list[$request->get('index')] = $blocks;
        $block_list->list = $list;
        $block_list->save();
        return ['data' => $blocks, 'index' => $request->get('index')];
    }

    public function destroyItem(Request $request, $id)
    {
        $block_list = BlockList::findOrFail($id);
        $list = $block_list->list;
        array_splice($list, $request->get('index'), 1);
        $block_list->list = $list;
        $block_list->save();
        return $request->get('index');
    }

    public function destroy($id)
    {
        $block_list = BlockList::findOrFail($id);
        $block_list -> delete();
        return $id;
    }

    public function sort(Request $request, $id)
    {
        $block_list = BlockList::findOrFail($id);
        $block_list->list = $request->get('list');
        $block_list->save();
        return 'success';
    }
}
