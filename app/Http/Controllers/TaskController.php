<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
class TaskController extends Controller
{
    public function create(Request $request){
        try{
            $validateUser = Validator::make($request->all(),[
                'title' => 'required',
                'discription' => 'required'
            ]);
            
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'The data is incomplete',
                    'errors' =>$validateUser->errors()
                ],401);
            }
            $Task = Task::create([
                'title' => $request->title,
                'discription' => $request->discription,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Your request has been successfully completed',
                'data' => $Task
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage(),
            ],500);
        }
    }
    public function update(Request $request, $id){
        try{
            $validateUser = Validator::make($request->all(),[
                'title' => 'required',
                'discription' => 'required'
            ]);
            
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'The data is incomplete',
                    'errors' =>$validateUser->errors()
                ],401);
            }
            $Task = Task::find($id);
            if(!$Task){
                return response()->json([
                    'status' => false,
                    'message' => 'Not found Task id',
                ],401);
            }
            $Task->title = $request->title;
            $Task->discription = $request->discription;
            $Task->save();
            return response()->json([
                'status' => true,
                'message' => 'Your request has been update completed',
                'data' => $Task
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage(),
            ],500);
        }
    }
    public function all(){
        $Task = Task::get();
        return response()->json([
            'status' => true,
            'message' => 'Your request has been successfully completed',
            'data' => $Task
        ],200);
    }
    public function show($id){
        $Task = Task::find($id);
        if(!$Task){
            return response()->json([
                'status' => false,
                'message' => 'Not found Task id',
            ],401);
        }
        return response()->json([
            'status' => true,
            'message' => 'Your request has been successfully completed',
            'data' => $Task
        ],200);
    }
}
