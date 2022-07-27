<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\ContentBlock;
use Illuminate\Http\Request;

class ContentBlockController extends Controller
{
    public function show($type)
    {
        $block = ContentBlock::firstOrCreate([
            'type' => $type
        ]);
        return $block;
    }
    public function update($id, Request $request)
    {
        $block = ContentBlock::findOrFail($id);
        $content = $request->all();
        if(is_array($request->get('image')) && array_key_exists('imageName', $request->get('image'))) {
            $image = $block -> addMediaFromBase64($request->get('image')['link'])->toMediaCollection('content-blocks');
            $content['image']['link'] = $image->getUrl();
            $content['image']['id'] = $image -> id;
            unset($content['image']['imageName']);
        }
        $block -> content = $content;
        $block->save();
        return $block;
    }
}
