<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TicketResource extends JsonResource
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
            'id' => $this->resource->id,
            'subject' => $this->resource->subject,
            'message' => $this->resource->message,
            'due_date' => Carbon::make($this->resource->due_date)->format('Y.m.d. H:i:s'),
            'person_name' => $this->resource->person->name,
            'person_email' => $this->resource->person->email,
            'created_at' => Carbon::make($this->resource->created_at)->format('Y.m.d. H:i:s'),
        ];
    }
}
