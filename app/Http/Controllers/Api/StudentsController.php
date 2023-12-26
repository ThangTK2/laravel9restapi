<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    // show list get students
    public function index(){
        $listStudents = Students::all();
        if($listStudents->count() > 0){
            return response()->json([
                'students' => $listStudents,
                'status' => 200
            ], 200);
        }else{
            return response()->json([
                'message' => 'No recodes found',
                'status' => 404
            ], 200);
        }
    }

    //create post student
    public function store(Request $request)
    {
        //validate data
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'digits: 10'], //Yêu cầu trường "phone" phải có đúng 10 chữ số
        ]);
        if($validate->fails()){
            return response()->json([
                'message' => $validate->errors(),
                'status' => 404
            ]);
        }else{
            $createStudent = Students::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            if($createStudent){
                return response()->json([
                    'message' => 'Created students successfully',
                    'status' => 200
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Created students error',
                    'status' => 500
                ], 500);
            }
        }
    }

    //get detail student
    public function show($id){
        $detailStudent = Students::find($id);
        if($detailStudent){
            return response()->json([
                'student' => $detailStudent,
                'status' => 200
            ], 200);
        }else{
            return response()->json([
                'message' => 'Detail student error',
                'status' => 404
            ], 404);
        }
    }

    //get edit student
    public function edit($id){
        $editStudent = Students::find($id);
        if($editStudent){
            return response()->json([
                'student' => $editStudent,
                'status' => 200
            ], 200);
        }else{
            return response()->json([
                'message' => 'Edit student error',
                'status' => 404
            ], 404);
        }
    }

    //put update student
    public function update(Request $request, $id){
        //validate data
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'digits: 10'], //Yêu cầu trường "phone" phải có đúng 10 chữ số
        ]);
        if($validate->fails()){
            return response()->json([
                'message' => $validate->errors(),
                'status' => 404
            ]);
        }else{
            $updateStudent = Students::find($id)->update([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            if($updateStudent){
                return response()->json([
                    'message' => 'Update student successfully',
                    'status' => 200
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Update student error',
                    'status' => 404
                ], 404);
            }
        }
    }

    //delete student
    public function destroy($id)
    {
        $deleteStudent = Students::find($id)->delete();
        if($deleteStudent){
            return response()->json([
                'message' => "Delete student successfully",
                'status' => 200
            ], 200);
        }else{
            return response()->json([
                'message' => 'Delete student error',
                'status' => 404
            ], 404);
        }
    }
}
