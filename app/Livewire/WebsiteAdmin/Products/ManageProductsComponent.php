<?php

namespace App\Livewire\WebsiteAdmin\Products;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ManageProductsComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteProduct'];//listen to emited action

    public $paginate;
    public $actionId;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $sn;
    public $blog;
    public $selProduct;

    use WithPagination;


    public function mount(){
        $this->paginate = 10;
    }
       //get record of blogs
       public function getProducts(){
        $podcasts = Product::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('product_name', 'like', '%'.$this->searchTerm.'%' )
                ->orWhere('description', 'like', '%'.$this->searchTerm.'%' );
            }
        })

        ->latest()->paginate($this->paginate);
        return $podcasts;
    }

    public function clearSearch(){
        $this->searchTerm = "";
    }

    public function setProduct(Podcast $product){
        $this->title = $product->title;
        $this->description = $product->description;
        $this->selProduct = $product;
    }
    //delete Service
    public function deleteProduct(){
        $product= Product::find($this->actionId);
        if($service){
            // unlink('guest/images/uploads/'.$service->service_icon);
            unlink('guest/images/uploads/'.$product->photo);
        }
        $product->delete();
        $this->dispatch('feedback',feedback:'Product Successfully Deleted');
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
        $products = $this->getProducts();
        return view('livewire.website-admin.products.manage-products-component',compact('products'))->layout('livewire.website-admin.layouts.app');
    }
}
