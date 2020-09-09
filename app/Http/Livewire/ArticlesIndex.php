<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticlesIndex extends Component
{
    use WithPagination;
    public $search;
    public $date_filter = "Today";
    public $orderBy = "id";
    public $orderDirection = "asc";
    public function render()
    {
        return view('livewire.articles-index',['articles' => $this->getArticles()]);
    }
    public function orderBy($field) {
        $current = $this->orderBy;
        $this->orderBy = $field;
        if ($field === $current) {
            $this->orderDirection = $this->orderDirection === "asc" ? "desc": "asc";
        }
    }
    public function getArticles(){
        $builder = Article::query();
        if ($this->search) {
            $builder->where("name", "LIKE", "%$this->search%")
                ->orWhere("slug", "LIKE", "%$this->search%");
        }
        return $builder->orderBy($this->orderBy,$this->orderDirection)
            ->paginate(10);
    }
}
