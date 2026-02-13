<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class EmployeeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Employee::query();

            // Search by name (if provided)
            if ($request->has('name') && !empty($request->name)) {
                $query->where('full_name', 'like', '%' . $request->name . '%');
            }

            // Search by email (if provided)
            if ($request->has('email') && !empty($request->email)) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }

            // Search by job title (if provided)
            if ($request->has('title') && !empty($request->title)) {
                $query->where('job_title', 'like', '%' . $request->title . '%');
            }

            // Search by department (if provided)
            if ($request->has('department') && !empty($request->department)) {
                $query->where('department', 'like', '%' . $request->department . '%');
            }

            // Search by location (if provided)
            if ($request->has('location') && !empty($request->location)) {
                $query->where('location', 'like', '%' . $request->location . '%');
            }

            // Search by employment type (if provided)
            if ($request->has('employment_type') && !empty($request->employment_type)) {
                $query->where('employment_type', 'like', '%' . $request->employment_type . '%');
            }

            // Search by status (if provided)
            if ($request->has('status') && !empty($request->status)) {
                $query->where('status', 'like', '%' . $request->status . '%');
            }


            // Select specific columns and paginate
            $employees = $query->select('id', 'full_name', 'email', 'job_title', 'department', 'location', 'employment_type', 'start_date', 'status')
                            ->paginate(10);

            // Append search parameters to pagination links
            $employees->appends($request->all());

            return response()->json([
                'success' => true,
                'data' => $employees
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve employees',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Request $request): JsonResponse
    {
        $employee = Employee::find($request->id);

        if ($employee) {
            return response()->json([
                'success' => true,
                'data' => [
                    'full_name' => $employee->full_name,
                    'dob' => $employee->dob,
                    'image_url' => $employee->image_url,
                    'address' => $employee->address,
                    'department' => $employee->department,
                    'next_of_kin' => $employee->name_nok,
                    'spouse' => $employee->spouse,
                    'phone_no_nok' => $employee->phone_no_nok,
                    'job_title' => $employee->job_title,
                    'emp_type' => $employee->employment_type,
                    'start_date' => $employee->start_date,
                    'current_salary' => $employee->current_salary,
                    'manager' => $employee->manager
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found'
            ], 404);
        }
    }
}
