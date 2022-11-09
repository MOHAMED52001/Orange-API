<?php

namespace App\Http\Repositories;

use App\Models\Instructor;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Interfaces\InstructorInterface;
use App\Http\Requests\Instructors\StoreInstructorRequest;
use App\Http\Requests\Instructors\UpdateInstructorRequest;

class InstructorRepository implements InstructorInterface
{
    use ApiResponseTrait;

    public function index()
    {
        return $this->apiResponse(200, "Success", null,     Instructor::all());
    }

    public function store(StoreInstructorRequest $request)
    {
        //Create New Instructor
        $data = $request->validated();

        $data['password'] = bcrypt($request->password);

        $instructor = Instructor::create($data);

        return  $this->apiResponse(200, "Instructor Created Successfully", null, $instructor);
    }

    public function show(Instructor $instructor)
    {
        return  $this->apiResponse(200, "Found Instructor", null, $instructor);
    }

    public function update(Instructor $instructor, UpdateInstructorRequest $request)
    {
        $instructor->update($request->all());

        return  $this->apiResponse(200, "Updated Successfully", null, $instructor);
    }

    public function destroy(Instructor $instructor)
    {
        Instructor::destroy($instructor->id);
        return $this->apiResponse(200, "Removed Successfully", null, $instructor);
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
