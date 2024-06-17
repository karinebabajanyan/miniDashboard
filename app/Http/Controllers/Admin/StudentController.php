<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentSearchRequest;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Resources\ShowStudentResource;
use App\Services\Country\CountryService;
use App\Services\Profile\ProfileService;
use App\Services\User\UserService;
use Inertia\Inertia;

class StudentController extends Controller
{
    protected $userService;
    protected $profileService;
    protected $countryService;
    public function __construct(UserService $userService, ProfileService $profileService, CountryService $countryService)
    {
        $this->userService = $userService;
        $this->profileService = $profileService;
        $this->countryService = $countryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(StudentSearchRequest $request)
    {
        $query = $request->get('query');
        $students = null;

        if ($query){
            $students = $this->userService->getPaginateSearchUsers('student', 10, $query);
        }else{
            $students = $this->userService->getPaginateUsers('student', 10);
        }

        $countries = $this->countryService->getCountries();

        return Inertia::render('Admin/Student/Index', [
            'students'=>ShowStudentResource::collection($students),
            'countries'=>$countries,
            'query'=>$query
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = $this->countryService->getCountries();

        return Inertia::render('Admin/Student/Create', ['countries'=>$countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request)
    {
        $message = null;
        $status = '';
        try {
            $user = $this->userService->createUser($request);
            $this->profileService->createProfile($request, $user);
            $this->userService->assignUserRole('student', $user);

            $message = 'Student created successfully';
            $status = 'success';
        }catch (\Exception $exception){
            $message = 'Something went wrong';
            $status = 'error';
        }


        return to_route('students.index')->with([
            'toast' => [
                'message' => $message,
                'status' => $status
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, string $id)
    {
        $message = null;
        $status = '';
        try {
            $user= $this->userService->updateUser($id, $request);
            $this->profileService->updateProfile($request, $user);

            $message = 'Student updated successfully';
            $status = 'success';
        }catch (\Exception $exception){
            $message = 'Something went wrong';
            $status = 'error';
        }


        return to_route('students.index')->with([
            'toast' => [
                'message' => $message,
                'status' => $status
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = null;
        $status = '';
        try {
            $this->userService->deleteUser($id);

            $message = 'Student deleted successfully';
            $status = 'success';
        }catch (\Exception $exception){
            $message = 'Something went wrong';
            $status = 'error';
        }


        return to_route('students.index')->with([
            'toast' => [
                'message' => $message,
                'status' => $status
            ]
        ]);
    }
}
