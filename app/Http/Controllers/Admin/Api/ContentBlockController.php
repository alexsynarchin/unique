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
        $block -> content = $request->except('image');
        if(array_key_exists('imageName', $block['image'])) {
            $image = $block ->addMediaFromBase64($block['image']['link'])
                ->toMediaCollection('content-blocks');
            $blocks['image']['link'] = $image->getUrl();
            $blocks['image']['id'] = $image -> id;
            unset($blocks['image']['imageName']);
        }
        $block->save();
        return $block;
    }
}
