<?php

namespace App\Http\Controllers\Ab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Str;


class StoreController extends Controller
{
    public $perPage;

    public function __construct() {
        $this->perPage = config('app.perPage');
    }

    //index
    public function index(Request $request)
    {
        $search = $request->search;

        $stores = Store::where(function ($query) use ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        })
        ->orderBy('id', 'desc')
        ->paginate($this->perPage);

        return view('ab.store.index', compact('stores'));
    }

    //create
    public function create()
    {
        return view('ab.store.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required',
            'number' => 'nullable|string|max:20',
            'status' => 'required',
		]);
        $user = auth()->user();
        //...
        $store = new Store();
        $store->user_id = $user->id;
        $store->name = $request->name;
        $store->slug = Str::of($request->name)->slug('-');
        $store->address = $request->address;
        $store->number = $request->number;
        $store->status = $request->status;

        //...files
        if($request->hasFile('files'))
        {
            $filesArray = [];

            $allowedfileExtension=['jpg','jpeg','png','webp'];
            $files = $request->file('images');
            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension, $allowedfileExtension);

                if($check){
                    //$file->store('files');
                    $path = $file->storeAs('files', $filename, 'public');
                   
                    array_push($filesArray, $filename);
                }
            }

            //...
            $store->images = json_encode($filesArray);
        }

        $store->save();
        if($user->store_id=='' || $user->store_id==null){
            $user->store_id = $store->id;
            $user->save();
        }

        $request->session()->flash('success', "Store added successfully");
        return redirect()->route('ab.store');
    }

    //edit
    public function edit(Store $store)
    {
        return view('ab.store.edit', compact('store'));
    }

    //update
    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required',
            'number' => 'nullable|string|max:20',
            'status' => 'required',
		]);


        //...
        $store->name = $request->name;
        $store->slug = Str::of($request->name)->slug('-');
        $store->address = $request->address;
        $store->number = $request->number;
        $store->status = $request->status;

        $filesArray = [];

        if(@$request->attachment){
            $filesArray = $request->attachment;
        }
            
        if($request->hasFile('files'))
        {

            $allowedfileExtension=['jpg','jpeg','png','webp'];
            $files = $request->file('images');
            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);

                if($check){
                    //$file->store('files');
                    $path = $file->storeAs('files', $filename, 'public');
                   
                    array_push($filesArray, $filename);
                }
            }
        }

        if($filesArray){
            $store->files = json_encode($filesArray);
        }

        $store->save();

        $request->session()->flash('success', "Store updated successfully");

        return redirect()->route('ab.store.show', $store->id);
    }

    //show
    public function show(Request $request, Store $store)
    {
        return view('ab.store.show', compact('store'));
    }

    //Delete
    public function destroy(Request $request, Store $store)
    {
		$store->delete();
		$request->session()->flash('success', 'Store deleted successfully');
		return redirect()->route("ab.store");
    }

    //set defaultStore
    public function defaultStore(Request $request)
    {
		$user = User::find(auth()->user()->id);
        $user->store_id = $request->store;
        $user->save();

		$request->session()->flash('success', 'Default Store set successfully');
		return redirect()->route("ab");
    }

}
