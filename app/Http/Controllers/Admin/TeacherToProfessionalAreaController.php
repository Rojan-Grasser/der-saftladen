<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherToProfessionalAreaController extends Controller
{
    public function index(Request $request, string $teacherId, string $areaId)
    {
        $teacher = Teacher::find($teacherId);

        // Teacher not found
        if ($teacher === null) {
            return [
                'success' => false,
                'message' => "Could not find teacher by id $teacherId",
            ];
        }

        // Teacher already allowed to see professional area
        if ($teacher->professionalAreas()->where('professional_areas.id', $areaId)->exists()) {
            return [
                'success' => false,
                'message' => 'The teacher already is allowed to see this professional area',
            ];
        }

        DB::table('user_to_professional_area')->insert([
            'professional_area_id' => $areaId,
            'user_id' => $teacherId,
        ]);

        return ['success' => true];
    }
}
