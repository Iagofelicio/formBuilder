<?php

namespace FormBuilder\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormQuestionResource extends JsonResource
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
            'form' => new FormResource($this->resource),
            'questions' => QuestionResource::collection($this->resource->questions)
        ];
    }
}
