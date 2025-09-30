<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        Carbon::setLocale('id');
        return [
            'id' => $this->id,
            'project_id' => $this->project_id ? (string)$this->project_id : '',
            'project' => $this->project ? $this->project->name : null,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status ? strtolower(str_replace(' ', '_', $this->status)) : 'pending',
            'created_by' => $this->creator ? $this->creator->name : null,
            'due_date' => $this->due_date ? Carbon::parse($this->due_date)->format('Y-m-d') : null,
            'due_date_display' => $this->due_date ? Carbon::parse($this->due_date)->translatedFormat('l, d F Y') : null,
            'assigned_to_id' => $this->assigned_to ? (string)$this->assigned_to : '',
            'assigned_to' => $this->assignedUser->name ?? null,
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('l, d F Y H:i'),
            'updated_at' => Carbon::parse($this->updated_at)->translatedFormat('l, d F Y H:i'),
        ];
    }
}
