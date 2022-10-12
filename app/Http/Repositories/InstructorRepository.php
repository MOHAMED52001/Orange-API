<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\InstructorInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstructorRepository implements InstructorInterface
{
    use ApiResponseTrait;

    public function index()
    {
        $instructors = Instructor::all();
        if (!is_null($instructors)) {
            return $this->apiResponse(200, "Success", null, $instructors);
        }
        return  $this->apiResponse(200, "There Is No Records In Database");
    }

    public function store(Request $request)
    {
        //Create New Instructor
        $formFilds = Validator::make($request->all(), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:instructors,email|string',
            'phone' => 'required|unique:instructors,phone|string',
            'national_id' => 'required|unique:instructors,national_id|string',
            'password' => 'required|confirmed|string',
        ]);

        if ($formFilds->fails()) {
            return  $this->apiResponse(200, "Validation Error", $formFilds->errors());
        }

        $instructor = Instructor::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'national_id' => $request->national_id,
            'password' => bcrypt($request->password),
        ]);


        $response = [
            'Instructor' => $instructor,
        ];

        return  $this->apiResponse(200, "Instructor Created Successfully", null, $response);
    }

    public function show($id)
    {
        $instructor = Instructor::find($id);

        if ($instructor != null) {
            return  $this->apiResponse(200, "Found Instructor", null, $instructor);
        } else {
            return  $this->apiResponse(200, "There Is No Records In Database That Match The Given Id");
        }
    }

    public function update(Request $request, $id)
    {
        $instructor = Instructor::find($id);

        if ($instructor != null) {
            $formFilds = Validator::make($request->all(), [
                'fname' => 'string',
                'lname' => 'string',
                'email' => 'email|unique:instructors,email|string',
                'phone' => 'unique:instructors,phone|string',
                'national_id' => 'unique:instructors,national_id|string',
            ]);

            if ($formFilds->fails()) {
                return  $this->apiResponse(200, "Validation Error", $formFilds->errors());
            }

            $instructor->update($request->all());
            $response = [
                'Instructor' => $instructor,
            ];

            return  $this->apiResponse(200, "Updated Successfully", null, $response);
        } else {
            return  $this->apiResponse(200, "There Is No Records In Database That Match The Given Id");
        }
    }

    public function delete($id)
    {
        $instructor = Instructor::find($id);

        if ($instructor != null) {
            $response = [
                "Removed" => $instructor
            ];
            Instructor::destroy($id);
            return $this->apiResponse(200, "Removed Successfully", null, $response);
        } else {
            return  $this->apiResponse(200, "There Is No Records In Database");;
        }
    }
    public function getCoursesThatBelongToInstructor($id)
    {
        $instructor = Instructor::find($id);
        if ($instructor != null) {

            $courses = $instructor->courses;

            if (count($courses) == 0) {
                return  $this->apiResponse(200, "This Instructor does not Has Any Courses");
            } else {
                $response = [
                    'Courses' => $courses
                ];
                return $this->apiResponse(200, "Courses That Belong To Instrucor :" . $id, null, $response);
            }
        } else {
            return  $this->apiResponse(200, "There Is No Records In Database That Match The Given Id");
        }
    }
}
