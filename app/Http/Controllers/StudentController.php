<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\ClassesResource;
use App\Http\Resources\SectionResource;
use App\Http\Resources\StudentResource;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = StudentResource::collection(Student::paginate(10));
        return inertia('Students/Index', [
            'students' => $students
        ]);
    }

    public function create()
    {
        $classes = ClassesResource::collection(Classes::all());
        $sections = SectionResource::collection(Section::all());

        return inertia('Students/Create', [
            'classes' => $classes,
            'sections' => $sections,
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
         Student::create($request->validated());
         return redirect()->to('/students');
    }
}
