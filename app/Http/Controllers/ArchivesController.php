<?php

namespace App\Http\Controllers;

use App\Models\Archives;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchivesController extends Controller
{
    public function index(){
        $tome = Archives::with('receiver')->where('receiver_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $sent = Archives::with('sender')->where('sender_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('crud.index', compact(['tome', 'sent']));
    }

    public function create(){

        $user = User::where('id', '!=', Auth::id())->get();
        // dd($user);
        return view('crud.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
            'receiver' => 'required',
            'attachment' => 'required|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg|max:20480'
        ]);
    
        $attachmentName = $request->file('attachment')->getClientOriginalName();
        $attachmentPath = $request->file('attachment')->storeAs('uploads', $attachmentName, 'public');
    
        $archive = new Archives();
        $archive->subject = $request->input('subject');
        $archive->content = $request->input('content');
        $archive->receiver_id = $request->input('receiver');
        $archive->attachment = '/storage/' . $attachmentPath;
        $archive->sender_id = Auth::id();
    
        $archive->save();
    
        return redirect('/home')->with('status', 'File uploaded successfully!');
    }
    

    public function detail($id){
        $archive = Archives::with('sender')->where('id', $id)->first();
        if($archive->sender_id == Auth::id()){
            $archive->is_seen == $archive->is_seen;
            $archive->save();
        }else{
            $archive->is_seen = true;
            $archive->save();
        }

        return view('crud.detail', compact('archive'));
    }


    public function edit($id){
        $archive = Archives::find($id)->first();
        // dd($user);
        return view('crud.edit', compact('archive'));
    }

    public function update(Request $request, $id){
            $request->validate([
                'subject' => 'required',
                'content' => 'required',
            ]);

            $archive = Archives::findOrFail($id);

            $archive->subject = $request->input('subject');
            $archive->content = $request->input('content');

            $archive->update();

            return redirect('/home');
    }

    public function bulkDelete(Request $request)
    {
        // Validate that 'ids' is an array and contains integer values
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer',
        ]);

        // Delete the archives with the given ids
        Archives::whereIn('id', $request->ids)->delete();

        // Redirect back with a success message
        return redirect('home')->with('success', 'Selected archives deleted successfully!');
    }
}
