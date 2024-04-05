<?php

namespace App\Services;

class SortService
{
    public $models = [
        'CheckSystem' => \App\Models\CheckSystem::class,
        'ContentBlock' => \App\Models\ContentBlock::class,
        'BlockList' => \App\Models\BlockList::class,
        'Service' => \App\Models\Service::class
    ];

    public function sort($modelName, $sort)
    {
        $class = $this->getModel($modelName);
        $model = new $class;
        foreach ($sort as $item) {

            $sort_item = $model::findOrFail($item['id']);
            $sort_item  -> menuindex = $item['menuindex'];
            $sort_item -> save();
        }
        return 'success';
    }
    public function getModel($model)
    {
        return $this->models[$model];
    }
}
