<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Products as ProductsModel;
use App\Models\Stock as StockModel;
use App\Models\StockProducts as StockProductsModel;
use Livewire\Attributes\On;

class Stock extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage;

    //page data
    public $title;
    public $type;

    //modals
    public $modelId;

    //fields
    public $vehicle_number;
    public $issue_date;
    public $issue_time;

    public $user;
    public $products = [];
    public $fieldsArray = [];


    //...
    public function mount()
    {
        $this->perPage = env('PER_PAGE');
        $this->user = auth()->user();
        $this->issue_date = date('Y-m-d');
        $this->issue_time = date('H:i');

        //...
        $this->products = ProductsModel::where('store_id', $this->user->store_id)
            ->where('user_id', $this->user->id)
            ->where('status', 'active')
            ->orderBy('id', 'desc')
            ->get();

        //...
        for($i=0; $i<=4; $i++){
            $this->addFields();
        }
    }

    //...
    public function modelData()
    {
        if($this->modelId){
            return [
                'vehicle_number' => $this->vehicle_number,
                'issue_date' => $this->issue_date,
                'issue_time' => $this->issue_time
            ];
        }
        return [
            'user_id' => $this->user->id,
            'store_id' => $this->user->store_id,
            'vehicle_number' => $this->vehicle_number,
            'issue_date' => $this->issue_date,
            'issue_time' => $this->issue_time,
            'type' => $this->type,
        ];
    }

    //...
    public function rules()
    {
		return [
            'vehicle_number' => 'required',
            'issue_date' => 'required',
            'issue_time' => 'required',
            'fieldsArray.*.product_id' => 'required',
            'fieldsArray.*.units' => 'required',
            'fieldsArray.*.kg' => 'required',
            // 'fieldsArray.*.price' => 'required',
        ];
    }

    //...
    public function createShowModal()
    {
        $this->resetFields();
    }

    #[On('select-product')]
    public function handleProduct($fieldId, $fieldValue)
    {
        $checkOldProduct = StockProductsModel::where('store_id', $this->user->store_id)
                ->where('product_id', $fieldValue)->orderBy('id', 'desc')->first();

        if($checkOldProduct){
            $this->fieldsArray[$fieldId]['stock'] = $checkOldProduct->new_stock;
        } else {
            $this->fieldsArray[$fieldId]['stock'] = 0;
        }
    }


    public function addFields()
    {
        //
        $data = [
            'product_id' => '',
            'units' => '',
            'kg' => '',
            'stock' => '',
            // 'price' => '',
        ];

        array_push($this->fieldsArray, $data);
        
    }

    public function removeField($id)
    {
        //
        $fields = $this->fieldsArray;

        unset($fields[$id]);

        $this->fieldsArray = array_values($fields);
    }


    //...
    public function create()
    {
        $this->validate();
        $store = StockModel::create($this->modelData());

        //...add products
        foreach($this->fieldsArray as $i => $fields){
            //...
            $checkOldProduct = StockProductsModel::where('store_id', $this->user->store_id)
                ->where('product_id', $fields['product_id'])->orderBy('id', 'desc')->first();

            $products = new StockProductsModel;
            $products->store_id = $this->user->store_id;
            $products->stock_id = $store->id;
            $products->product_id = $fields['product_id'];
            $products->units = $fields['units'];
            $products->kg = $fields['kg'];
            //$products->price = $fields['price'];

            if($this->type=='inword'){
                $products->new_stock = $checkOldProduct ? $checkOldProduct->new_stock + $fields['kg'] : $fields['kg'];
            }
            if($this->type=='outword'){
                $products->new_stock = $checkOldProduct ? $checkOldProduct->new_stock - $fields['kg'] : -$fields['kg'];
            }

            $products->save();
        }
        //
        request()->session()->flash('success', $this->title." Added Successfully");
		$this->redirectTo();
    }
    
    //...
    public function editShowModal($id)
    {
        $this->resetFields();
        $this->modelId = $id;
        $data = StockModel::findOrFail($id);
        
        if($data){
            $this->vehicle_number = $data->vehicle_number;
            $this->issue_date = $data->issue_date;
            $this->issue_time = $data->issue_time;
        }
    }

    //...
    public function update()
    {
        $this->validate();
        StockModel::find($this->modelId)->update($this->modelData());
        //
        request()->session()->flash('success', $this->title." Updated Successfully");
		$this->redirectTo();
    }

    //...
    public function redirectTo()
    {
        return redirect()->route("ab.".strtolower($this->title));
    }






    //...
    public function resetFields()
    {
        $this->resetValidation();
        //fields
        $this->vehicle_number = '';
        $this->issue_date = '';
        $this->issue_time = '';
        $this->modelId = '';
    }
    
    //...
    public function hallChanged()
    {
        $this->showTable = true;
    }

    public function render()
    {
        $stockData = StockModel::where('user_id', $this->user->id)
            ->where('store_id', $this->user->store_id)
            ->where('type', strtolower($this->title))
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        return view('livewire.stock', ['stockData'=>$stockData]);
    }
}
