<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function create_process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|digits_between:9,15',
            'type' => 'required|in:regular,vip',
        ]);
    
        $member = new Member();
        $member->name = $request->name;
        $member->email = $request->email;
        $member->phone = $request->phone;
        $member->type = $request->type;
    
        if ($member->save()) {
            return response()->json(['success' => 'Submit Success']);
        } else {
            return response()->json(['error' => 'Submit Fail'], 500);
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

        return view('view', compact('member'));
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
    
}
