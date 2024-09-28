<?php

namespace App\Http\Controllers;

use App\Models\Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriveController extends Controller
{
    public function __constract()
    {
        $this->middleware('auth');
    }

    public function allDrives()
    {
        $drives = Drive::all();
        return view('drives.allDrives')->with('drives', $drives);
    }

    public function publicFiles()
    {
        $drives = DB::table("drives")->where("status", "=", 'public')->get();

        return view('drives.public')->with('drives', $drives);
    }

    public function index()
    {
        $userId = auth()->user()->id;
        // when we dont have model use this code ->
        $drives = DB::table("drives")->where("userid", "=", $userId)->get();
        /*
        or we can use this code when we have model
        $drives = Drive::where('userid' , $userId)->get(); // has internal equal operator
        */
        return view('drives.index')->with('drives', $drives);
    }

    public function create()
    {
        $drive = new Drive();
        return view('drives.create')->with('drive', $drive);
    }


    public function store(Request $request)
    {
        $size = 1024 * 10;

        $request->validate([
            'title' => 'required|min:2|max:35|string',
            'description' => 'required|min:5|max:200|string',
            "inputFile" => "required|mimes:png,jpg,pdf|max:$size"
        ]);
        $drive = new Drive();
        $drive->title = $request->title;
        $drive->description = $request->description;
        $drive->status = $request->status;

        //upload file name , location
        $drive_Data = $request->file('inputFile');
        $drive_name = time() . $drive_Data->getClientOriginalName();
        $location = public_path('./drives/');
        $drive_Data->move($location, $drive_name);
        $drive->file = $drive_name;
        $drive->userid = auth()->user()->id;
        $drive->save();
        return redirect()->back()->with('done', 'Uploaded File Done');
    }


    public function show($id)
    {
        $drive = Drive::find($id);
        return view('drives.show')->with('drive', $drive);
    }

    public function showPublicFiles($id)
    {
        $drive = DB::table('joindrivewithuser')->get()->first();
        return view('drives.showPublicFiles')->with('drive', $drive);
    }


    public function edit($id)
    {
        $drive = Drive::find($id);
        return view('drives.edit')->with('drive', $drive);
    }

    public function update(Request $request, $id)
    {
        $drive = Drive::find($id);
        $drive->title = $request->title;
        $drive->description = $request->description;

        //upload file name , location
        $drive_Data = $request->file('inputFile');
        if ($drive_Data != null) {
            $drive_name = time() . $drive_Data->getClientOriginalName();
            $location = public_path('./drives/');
            $drive_Data->move($location, $drive_name);
            $path = public_path() . "/drives/" . $drive->file;
            unlink($path);
        } else {
            $drive_name = $drive->file;
        }

        $drive->file = $drive_name;
        $drive->save();
        return redirect()->route('drive.index')->with('done', 'Updated File Done');
    }

    public function destroy($id)
    {
        $drive = Drive::find($id);
        $path = public_path() . "/drives/" . $drive->file;
        unlink($path);
        $drive->delete();
        return redirect()->route('drive.index')->with('done', 'Deleted File Done');
    }
    public function download($id)
    {
        $drive = Drive::find($id);
        $driveName = $drive->file;

        $path = public_path() . "/drives/" . $driveName;

        return response()->download($path);
    }

    public function changeStatus($id)
    {
        $drive = Drive::find($id);
        if ($drive->status == 'private') {
            $drive->status = 'public';
            $drive->save();
            return redirect()->route('drive.index')->with('done', 'File Changed To Public Successfully!');
        } else {
            $drive->status = 'private';
            $drive->save();
            return redirect()->route('drive.index')->with('done', 'File Changed To Private Successfully!');
        }
    }
}
