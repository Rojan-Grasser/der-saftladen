<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use DB;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = trim($request->validate(['query' => ['nullable', 'string', 'max:255']])['query'] ?? '');

        $query = DB::table('users')
            ->select('id', 'email', 'name');

        if ($name !== '') {
            $query->where('name', 'like', '%' . $name . '%')
                ->orWhere('email', 'like', '%' . $name . '%');
        }

        $query->where('role', '=', UserRole::TEACHER);

        return response()->json($query->get());
    }
}
