<?php

namespace App\Http\Controllers;

use App\Models\AddressType;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Addresses;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function create()
    {
        $address_types = AddressType::getAddressTypes();

        return view('create', compact('address_types')); 

    }

    public function create_process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|digits_between:9,15',
            'type' => 'required|in:regular,vip',
        ]);

        try {
            DB::beginTransaction();

            $member = new Member();
            $member->name  = $request->name;
            $member->email = $request->email;
            $member->phone = $request->phone;
            $member->type  = $request->type;

            if (!$member->save()) {
                throw new \Exception('Member save failed');
            }

            $address = new Addresses();
            $address->accid    = $member->id;
            $address->location = $request->location;
            $address->address_type = $request->address_type;
            $address->remark    = '';

            if (!$address->save()) {
                throw new \Exception('Address save failed');
            }

            DB::commit();
            return response()->json(['success' => 'Submit Success']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Submit Fail', 'message' => $e->getMessage()], 500);
        }
    }

    public function list(Request $request)
    {
        $query = Member::query();
    
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        $sortBy = request('sortBy', 'id');
        $sortOrder = request('sortOrder', 'asc');
        $perPage = request('perPage', 10);
        
        $members = $query->orderBy($sortBy, $sortOrder)->paginate($perPage);
    
        return view('list', compact('members', 'sortBy', 'sortOrder', 'perPage'));
    }

    public function view(Request $request)
    {
        if (!$request->has('id') or $request->id == '') {
            $member = '';
        }else{
            $member = Member::where('id',$request->id)->first();
        }

        $address_types = AddressType::getAddressTypes();

        return view('view', compact('member','address_types'));
    }

    public function delete_process(Request $request)
    {
        
        if (!$request->has('id')) {
            return response()->json(['error' => 'No Found ID'], 404);
        }
    
        $member = Member::find($request->id);
        if (!$member) {
            return response()->json(['error' => 'No Found Member'], 404);
        }
    
        $member->delete();
    
        return '';
    }

    public function update_process(Request $request){    
        try {
            DB::beginTransaction();
    
            $member = Member::find($request->id);
            if (!$member) {
                return response()->json(['error' => 'Member not found'], 404);
            }
    
            $member->update([
                'name'  => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type'  => $request->type,
            ]);
    
            DB::commit();
            return response()->json(['success' => 'Update Success']);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Update Fail', 'message' => $e->getMessage()], 500);
        }
    }
    
    
    
}
