<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IssueResource extends JsonResource
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
            'task_id' => $this->task_id,
            'task' => $this->task ? $this->task->title : null,
            'title' => $this->title,
            'description' => $this->description,
            'status' => ucwords(str_replace('_', ' ', $this->status)),
            'due_date' => $this->due_date ? Carbon::parse($this->due_date)->format('Y-m-d') : null,
            'due_date_display' => $this->due_date ? Carbon::parse($this->due_date)->translatedFormat('l, d F Y') : null, 'created_by' => $this->created_by,
            'assigned_to_id' => $this->assigned_to,
            'assigned_to' => $this->assignedUser->name ?? null,
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('l, d F Y H:i'),
            'updated_at' => Carbon::parse($this->updated_at)->translatedFormat('l, d F Y H:i'),
        ];
    }
}
