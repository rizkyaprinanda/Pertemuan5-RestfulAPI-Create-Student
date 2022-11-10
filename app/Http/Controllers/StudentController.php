<?php

namespace App\Http\Controllers;
#mengimport model Student
# digunakan untuk berinteraksi dengan database student
use App\Models\Student;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class StudentController extends Controller
{
    // membuat methode index
    
    public function index(){
        #memanggil methode getAllStudents dari model Student
        $students = Student::all();

        $data = [
            'message'=>'Get all students',
            'data' => $students,
        ];
        return response()->json($data, 200);
    }

    # membuat methode store untuk menambahkan resource student
    public function store(Request $request){
        # menangkap data request
        $input = [
            'nama'=>$request->nama,
            'nim'=>$request->nim,
            'email'=>$request->email,
            'jurusan'=>$request->jurusan,
        ];
        
        #mengguanakan model Student untuk insert data
        $student = Student::create($input);

        $data = [
            'message'=>'Student is created succesfully',
            'data'=>$student,
        ];

        # mengembalikan data (json) status code 201
        return response()->json($data, 201);
    }

    # membuat methode store untuk menambahkan resource student
    public function update(Request $request, $id){
        $student = Student::find($id);

        if ($student) {
            # mendapatkan data request
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan,
            ];
            # mengupdate data
            $student->update($input);


        $data = [
            'message'=>'Student is change succesfully',
            'data'=>$student,
        ];
        return response()->json($data, 200);

    }   else {
        $data = [
            'message'=>'Student not found',
            'data'=>$student,
        ];
        return response()->json($data, 404);

    }

        # mengembalikan data (json) status code 201
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student){
        $student->delete();
        $data = [
            'message'=>'Student has been deleted', 
        ];
        return response()->json($data, 201);
    }   else {
        $data = [
            'message'=>'Student not found',
        ];
        return response()->json($data, 404);
        }
    
    }
    
}