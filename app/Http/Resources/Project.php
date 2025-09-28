<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Project extends JsonResource
{
    public function toArray(Request $request): array
    {
        Carbon::setLocale('id');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'created_by' => $this->user ? $this->user->name : null,
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('l, d F Y H:i'),
            'updated_at' => Carbon::parse($this->updated_at)->translatedFormat('l, d F Y H:i'),
        ];
    }
}
