<?php

namespace FormBuilder\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionRestrictionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'question' => new QuestionResource($this->resource),
            'restrictions' => RestrictionResource::collection($this->resource->restrictions)
        ];
    }
}
