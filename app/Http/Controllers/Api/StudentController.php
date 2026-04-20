<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::query()->latest('id')->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data students',
            'data' => StudentResource::collection($students),
        ]);
    }

    public function show(string $id)
    {
        $student = Student::find($id);

        if (! $student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil detail student',
            'data' => new StudentResource($student),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:50', 'unique:students,nim'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'prodi' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors(),
            ], 422);
        }

        $student = Student::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan student',
            'data' => new StudentResource($student),
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $student = Student::find($id);

        if (! $student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:50', Rule::unique('students', 'nim')->ignore($student->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('students', 'email')->ignore($student->id)],
            'prodi' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors(),
            ], 422);
        }

        $student->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengubah data student',
            'data' => new StudentResource($student->fresh()),
        ]);
    }

    public function destroy(string $id)
    {
        $student = Student::find($id);

        if (! $student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found',
            ], 404);
        }

        $studentResource = new StudentResource($student);
        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus student',
            'data' => $studentResource,
        ]);
    }
}
