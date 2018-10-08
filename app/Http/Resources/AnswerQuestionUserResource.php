<?php

namespace FormBuilder\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnswerQuestionUserResource extends JsonResource
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
            'id' => (int)$this->id,
            'user_id' => (int)$this->user_id,
            'answer_id' => (int)$this->answer_id,
            'question_id' => (int)$this->question_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
