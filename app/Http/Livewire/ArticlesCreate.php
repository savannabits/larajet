<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Illuminate\Support\Str;
use Livewire\Component;

class ArticlesCreate extends Component
{
    public $data;
    public $state;
    public $error;

    protected $rules = [
        "data.name" => "required",
        "data.description" =>"required",
        "state" => "required"
    ];
    public function mounted() {
        $this->setData();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.articles-create');
    }
    public function save() {
        $this->error = null;
        $this->validate();
        try {
            $article = new Article();
            $article->forceFill($this->data);
            $article->slug = Str::slug($article->name);
            $article->saveOrFail();
            $this->setData();
            return redirect()->route('article.index');
        } catch (\Throwable $exception) {
            $error = $exception->getMessage();
            if (str_contains($error,"Integrity constraint violation: 1062")) {
                $this->error = "Duplicate entry detected: The record already exists";
            } else {
                $this->error = $exception->getMessage();
            }
        }
    }
    public function setData() {
        $this->data = [
            "name" => "",
            "description" => "",
        ];
        $this->state = null;
    }
}
