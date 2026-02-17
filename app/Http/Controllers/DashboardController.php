<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Symfony\Component\HttpFoundation\JsonResponse;

class DashboardController extends Controller
{
    public function index(): JsonResponse{
        return response()->json([
            'total_employees' => Employee::count(),
            'new_hire_count'=> 12,
            'upcoming_event' => 34,
            'open_positions' => 4
        ] ,200);
    }
}
