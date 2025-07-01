<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = DB::table('cities')->latest()->distinct()->get();
        $state = DB::table('states')->latest()->distinct()->get();
        $user_id = 0;

        
        return view('address.index',compact('city','state','user_id'));
    }
    
    
    public function index1($user_id)
    {
        $city = DB::table('cities')->get(); // Or add ->orderBy('name') if needed
        $state = DB::table('states')->get();
    
        $user = User::findOrFail($user_id); // safer than first()
        $phone = $user->phone;
    
    return view('address.index1', compact('city', 'state', 'user_id', 'phone'));
    }

    public function getCities(Request $request)
    {
        // $cities = DB::table('cities')->where('state_id', $request->state_id)->get();
        $cities = DB::table('cities')->where('state_id', $request->state_id)->orderBy('name', 'asc')->get();

        return response()->json($cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address_cnt = DB::table('addresses')->where('user_id',Auth::user()->id)->count();
             
        if($address_cnt == 0)
        {
            $default = 1;
        }
        else{
             $default = 0;
        }

        // Manually override the 'is_default' value if not provided (to ensure it's correct)
         $request->merge(['is_default' => $default]);
    
        // Create a new address record
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        $address = Address::create($data);    
        return redirect('/addtocart');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        $city = DB::table('cities')->latest()->distinct()->get();
        $state = DB::table('states')->latest()->distinct()->get();

       
       return view('address.edit',compact('address','city','state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request, Address $address)
  {
        $address->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'pincode' => $request->pincode,
            'state' => $request->registered_state,
            'city' => $request->registered_city,
            'address' => $request->address,
        ]);
    
        return redirect()->back()->with('success', 'Address updated successfully.');
  }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();
        
        return back()->with('success','Address Deleted successfully');
    }

    public function tryout(){
        return view('user.tryout');
    }
    public function payment(){
        return view('user.payment');
    }
    public function wallet(){
        return view('user.wallet');
    }
    public function address(){
        return view('user.address');
    }


}
