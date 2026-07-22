<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;

class ProjectsIndex extends Component
{
    public function render()
    {
        $projects = Project::where('is_published', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.projects-index', [
            'projects' => $projects,
        ])->layout('layouts.app');
    }
}
