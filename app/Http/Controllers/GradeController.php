<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $result = Grade::all();
            return json_encode($result);
            // return response()->json([
            //     'code' => 200,
            //     'msg' => 'data available',
            //     'data' => $result
            // ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'msg' => 'Error',
                'data' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = Validator::make(
            $request->all(),
            [
                'nilai' => 'required',
                'matkul' => 'required',
                'user_id' => 'required',
            ]
        );

        if ($validated->fails()) {
            return response()->json([
                'code' => 403,
                'message' => 'validation error',
                'errors' => $validated->errors(),
            ], 403);
        } else {
            $data = [
                'nilai' => $request->nilai,
                'matkul' => $request->matkul,
                'user_id' => $request->user_id,
            ];
            try {
                Grade::create($data);
                return response()->json([
                    'code' => 200,
                    'msg' => 'grade successfully added',
                    'data' => null,
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'code' => 500,
                    'msg' => 'Error',
                    'data' => $th->getMessage(),
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        //
        $validated = Validator::make(
            $request->all(),
            [
                'nilai' => 'required',
                'matkul' => 'required',
                // 'user_id' => 'required',
            ]
        );

        if ($validated->fails()) {
            return response()->json([
                'code' => 403,
                'message' => 'validation error',
                'errors' => $validated->errors(),
            ], 403);
        } else {
            $data = [
                'nilai' => $request->nilai,
                'matkul' => $request->matkul,
                // 'user_id' => $request->user_id,
            ];
            try {
                Grade::where('id', $grade->id)->update($data);
                return response()->json([
                    'code' => 200,
                    'msg' => 'grade successfully updated',
                    'data' => null,
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'code' => 500,
                    'msg' => 'Error',
                    'data' => $th->getMessage(),
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
        try {
            Grade::destroy($grade->id);
            return response()->json([
                'code' => 200,
                'msg' => 'successfully deleted',
                'data' => $grade->id
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'msg' => 'Error',
                'data' => $th->getMessage(),
            ], 500);
        }
    }

    public function getById($id)
    {
        $grade = Grade::where('id', '=', $id)->first();
        return json_encode($grade);
    }
}
