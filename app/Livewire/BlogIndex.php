<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPost;
use Livewire\WithPagination;

class BlogIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = null;
    public $sortBy = 'latest';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
    }

    public function isNewPost($createdAt)
    {
        return $createdAt->diffInDays(now()) < 7;
    }

    public function getReadTime($content)
    {
        $words = str_word_count(strip_tags($content));
        $minutes = ceil($words / 200);
        return $minutes;
    }

    public function render()
    {
        $categories = \App\Models\BlogCategory::has('posts')->get();

        $featuredPosts = BlogPost::where('is_published', true)
            ->with(['category', 'user'])
            ->latest()
            ->take(3)
            ->get();
        $featuredIds = $featuredPosts->pluck('id')->toArray();

        $posts = BlogPost::where('is_published', true)
            ->with(['category', 'user'])
            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedCategory, function ($query) {
                $query->where('blog_category_id', $this->selectedCategory);
            })
            ->when($this->sortBy === 'popular', function ($query) {
                $query->orderBy('views', 'desc');
            })
            ->when($this->sortBy === 'oldest', function ($query) {
                $query->oldest();
            })
            ->when($this->sortBy === 'latest', function ($query) {
                $query->latest();
            })
            ->paginate(12);

        return view('livewire.blog-index', [
            'featuredPosts' => $featuredPosts,
            'posts' => $posts,
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
