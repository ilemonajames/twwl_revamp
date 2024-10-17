<?php

namespace App\Livewire\WebsiteAdmin\Blogs;

use Livewire\Component;
use App\Models\Blog;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
class BlogsComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteBlog'];//listen to emited action

    public $paginate;
    public $actionId;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $sn;
    public $blog;
    public $selBlog;

    use WithPagination;


    public function mount(){
        $this->paginate = 10;
    }
       //get record of blogs
       public function getBlogs(){
        $blogs = Blog::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('blog_title', 'like', '%'.$this->searchTerm.'%' )
                ->orWhere('description', 'like', '%'.$this->searchTerm.'%' );
            }
        })

        ->latest()->paginate($this->paginate);
        return $blogs;
    }

    public function clearSearch(){
        $this->searchTerm = "";
    }

    public function setBlog(Blog $blog){
        $this->blog_title = $blog->title;
        $this->description = $blog->description;
        $this->selBlog = $blog;
    }
    //delete Service
    public function deleteBlog(){
        $blog= Blog::find($this->actionId);
        if($blog){
            unlink('guest/images/uploads/'.$blog->image);
        }
        $blog->delete();
        $this->dispatch('feedback',feedback:'Blog Successfully Deleted');
    }

    //set action id
    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function setService(Blog $blog){
        $this->blog = $blog;
    }


    public function render()
    {
        $blogs = $this->getBlogs();
        return view('livewire.website-admin.blogs.blogs-component',compact('blogs'))->layout('livewire.website-admin.layouts.app');
    }
}
