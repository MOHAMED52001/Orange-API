<?php

namespace App\Http\Repositories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentCourse;
use App\Models\StudentEnrollCourse;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Interfaces\StudentInterface;
use Illuminate\Support\Facades\Validator;

class StudentRepository implements StudentInterface
{
    use ApiResponseTrait;

    public function index()
    {
        $students = Student::all();

        if (is_null($students)) {
            return  $this->apiResponse(404, "There Is No Records In Database");
        }

        return $this->apiResponse(200, "Record Found", null, $students);
    }

    public function store(Request $request)
    {
        //Create New Student
        $formFilds = Validator::make($request->all(), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:students,email|string',
            'phone' => 'required|unique:students,phone|string',
            'national_id' => 'required|unique:students,national_id|string',
            'password' => 'required|confirmed|string',
        ]);

        if ($formFilds->fails()) {
            return $this->apiResponse(400, "Validation Error", $formFilds->errors());
        }

        $student = Student::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'national_id' => $request->national_id,
            'password' => bcrypt($request->password),
        ]);

        $response = [
            'Student' => $student,
        ];

        return $this->apiResponse(201, "Created Successfully", null, $response);
    }

    public function show($id)
    {
        $student = Student::find($id);

        if ($student != null) {
            return $this->apiResponse(200, "Records Found", null, $student);
        } else {
            return  $this->apiResponse(400, "There Is No Records That Match The Given Id In Database");
        }
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student != null) {
            $formFilds = Validator::make($request->all(), [
                'fname' => 'string',
                'lname' => 'string',
                'email' => 'email|unique:students,email|string',
                'phone' => 'unique:students,phone|string',
                'national_id' => 'unique:students,national_id|string',
            ]);

            if ($formFilds->fails()) {
                return $this->apiResponse(400, "Validation Error", $formFilds->errors());
            }

            $student->update($request->all());
            $response = [
                'Student' => $student,
            ];

            return  $this->apiResponse(201, "Updated Successfully", null, $response);
        } else {
            return  $this->apiResponse(400, "There Is No Records That Match The Given Id In Database");
        }
    }

    public function delete($id)
    {
        $student = Student::find($id);

        if ($student != null) {
            $response = [
                'Student Removed' => $student
            ];
            Student::destroy($id);
            return  $this->apiResponse(201, "Removed Successfully", null, $response);
        } else {
            return  $this->apiResponse(404, "There Is No Records That Match The Given Id In Database");
        }
    }

    public function getStudentSkills($id)
    {
        $student = Student::with(['skills' => function ($query) {
            $query->select('skill');
        }])->find($id);

        if ($student != null) {
            $skills = $student->skills;

            if (count($skills) == 0) {
                return  $this->apiResponse(404, "Student Has No Skills");
            } else {

                return  $this->apiResponse(200, "Success", null, $skills);
            }
        } else {
            return  $this->apiResponse(404, "There Is No Records That Match The Given Id In Database");
        }
    }

    public function getStudentCourses($id)
    {
        $student = Student::with(['courses' => function ($query) {
            $query->select('title');
        }])->find($id);

        if ($student != null) {
            $courses = $student->courses;

            if (count($courses) == 0) {
                return  $this->apiResponse(404, "Student Has No Courses");
            } else {

                return  $this->apiResponse(200, "Student Courses", null, $courses);
            }
        } else {
            return  $this->apiResponse(404, "There Is No Records That Match The Given Id In Database");
        }
    }
    public function attachNewSkills(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student != null) {

            $student->skills()->syncWithoutDetaching($request->Skills);

            return  $this->apiResponse(201, "Successfully Added New Skills", null, $student->skills);
        } else {
            return  $this->apiResponse(404, "There Is No Records That Match The Given Id In Database");
        }
    }
    public function detachSkills(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student != null) {

            $student->skills()->detach($request->Skills);

            return  $this->apiResponse(200, "Successfully Removed Given Skills", null, $student->skills);
        } else {
            return  $this->apiResponse(404, "There Is No Records That Match The Given Id In Database");
        }
    }
    public function enrollStudentInCourse(Request $request, $id)
    {
        //Check if the student is already in the course
        $student_course_record = StudentEnrollCourse::where('student_id', $id)->first();

        if ($student_course_record != null) {

            $current_date_time = \Carbon\Carbon::now()->toDateTimeString();
            if ($student_course_record->end_date <= $current_date_time) {

                $student = Student::find($id);

                $course = Course::find($student_course_record->course_id);

                $student->skills()->syncWithoutDetaching($course->skills);

                StudentEnrollCourse::destroy($student_course_record->id);

                // Add The Finished Course To StudentCourse Records
                $record_to_save_in_student_course = [
                    'student_id' => $student_course_record->student_id,
                    'course_id' => $student_course_record->course_id
                ];

                StudentCourse::create($record_to_save_in_student_course);

                $Enroll_The_student_in_new_course = [
                    'student_id' => $id,
                    'course_id' => $request->course_id
                ];

                StudentEnrollCourse::create($Enroll_The_student_in_new_course);

                $response = ["Enrolled In Course" => [
                    "StudentFinshedCourse" => $record_to_save_in_student_course,
                    "Student Enrolled In New Course" => $Enroll_The_student_in_new_course
                ]];

                return $this->apiResponse(201, "Student Enrolled In New Course", null, $response);
            } else {
                return $this->apiResponse(400, "This Student Is Enrolled In Unfinished Course");
            }
        } else {

            $Enroll_The_student_in_new_course = [
                'student_id' => $id,
                'course_id' => $request->course_id
            ];
            StudentEnrollCourse::create($Enroll_The_student_in_new_course);
            return $this->apiResponse(201, "Student Enrolled In New Course", null, $Enroll_The_student_in_new_course);
        }
    }
    public function recommendCourses($id)
    {
        $student = Student::find($id);
        if (!is_null($student)) {
            $student_skills = $student->skills;

            $skills = [];
            foreach ($student_skills as $key => $value) {
                $skills[] = $value['skill'];
            }

            $courses = Course::with('reqSkills')
                ->whereHas('reqSkills', function ($q) use ($skills) {
                    $q->whereIn('skill', $skills);
                })
                ->get();

            return  $this->apiResponse(200, "Recommended Courses", null, $courses);
        }
        return  $this->apiResponse(404, "There Is No Records That Match The Given Id In Database");
    }
}
