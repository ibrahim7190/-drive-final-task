<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drive;

class DriveAPICOntroller extends Controller
{
    public function index()
    {
        $drives = Drive::all();
        $message = [
            "Message" => "Get All Data Done",
            "Data" => $drives,
            "status" => 200,
        ];
        return response($message, 200);
    }

    public function store(Request $request)
    {
        $size = 1024 * 10;

        $request->validate([
            'title' => 'required|min:2|max:35|string',
            'description' => 'required|min:5|max:200|string',
            "inputFile" => "required|mimes:png,jpg,pdf|max:$size"
        ]);

        //upload file name , location
        if ($request->hasFile('inputFile')) {
            $drive_Data = $request->file('inputFile');
            $drive_name = time() . $drive_Data->getClientOriginalName();
            $location = public_path('./drives/');
            $drive_Data->move($location, $drive_name);
        }


        $drive = Drive::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $drive_name,
            'userid' => 1,
            'status' => "private"
        ]);

        $message = [
            "Message" => " Data Created Successfuly",
            "Data" => $drive,
            "status" => 201,
        ];
        return response($message, 201);
    }

    public function update(Request  $request, $id)
    {

        $size = 1024 * 10;

        $drive = Drive::find($id);
        //upload file name , location
        $drive_Data = $request->file('inputFile');
        if ($drive_Data != null) {
            $request->validate([
                'title' => 'required|min:2|max:35|string',
                'description' => 'required|min:5|max:200|string',
                "inputFile" => "required|mimes:png,jpg,pdf|max:$size"
            ]);
            $drive_name = time() . $drive_Data->getClientOriginalName();
            $location = public_path('./drives/');
            $drive_Data->move($location, $drive_name);
            $path = public_path() . "/drives/" . $drive->file;
            unlink($path);
        } else {
            $drive_name = $drive->file;
        }

        $drive->update([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $drive_name,
            'userid' => 1,
            'status' => "private"
        ]);

        $message = [
            "Message" => " Data Updated Successfuly",
            "Data" => $drive,
            "status" => 201,
        ];
        return response($message, 201);
    }

    public function delete($id)
    {
        $drive = Drive::destroy($id);
        $message = [
            "Message" => "Data Deleted Successful",
            "Data"=> $drive,
            "status" => 200
        ];
        // $path = public_path() . "/drives/" . $drive->file;
        // unlink($path);
        return response($message, 200);
    }
}
