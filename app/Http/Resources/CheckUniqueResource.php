<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckUniqueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'viewed' => $this->viewed,
            'formatted_date'=> $this->formatted_date,
            'sum' => $this->sum,
            'type_title' => $this->type_title,
            'reports' =>  $this->reports()->with('checkSystem')->get(['id', 'system_id','created_at', 'error_code']),
            'services' => $this->services-> toArray(),
        ];
    }
}
