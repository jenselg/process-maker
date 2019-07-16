<?php

namespace App\Http\Controllers;

use App\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (Process::all()) {
        return response(Process::all(), 200);
      } else {
        return response("Invalid API Call!", 400);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $process = new Process();
      $process->uuid = Str::uuid();
      $process->name = trim($request->input('name'));
      $process->description = trim($request->input('description'));
      $process->code = trim($request->input('code'));
      $process->status = $request->input('status');
      if($process->save()) {
        return response($process, 201);
      } else {
        return response("Invalid API Call!", 400);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $process = Process::findOrFail($id);
      $process->name = trim($request->input('name'));
      $process->description = trim($request->input('description'));
      $process->code = trim($request->input('code'));
      $process->status = $request->input('status');
      if ($process->save()) {
        return response($process, 201);
      } else {
        return response("Invalid API Call!", 400);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $process = Process::findOrFail($id);
      if ($process->delete()) {
        return response($process, 200);
      } else {
        return response("Invalid API Call!", 400);
      }
    }

}
