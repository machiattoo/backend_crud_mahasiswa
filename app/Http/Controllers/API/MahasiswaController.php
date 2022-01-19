<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::latest()->get();
        $response = [
            'message'   => 'Data mahasiswa berhasil diambil',
            'data'      => $mahasiswa
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function show(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        try {
            $response = [
                'message'   => 'Data mahasiswa ditemukan dengan pemilik account ' . $mahasiswa->fullname,
                'data'      => $mahasiswa
            ];
        } catch (Exception $error) {
            $error = Response::HTTP_NOT_FOUND;
            $response = [
                'message'   => 'Data is not found',
                'data'      => null,
                'error'     => $error
            ];
        }

        return response()->json($response, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname'  => ['required', 'string', 'max:200'],
            'username'  => ['required', 'string', 'max:100', 'unique:mahasiswas']
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $mahasiswa = Mahasiswa::create($request->all());
            return response()->json([
                'message'       => 'Data mahasiswa berhasil ditambahkan',
                'mahasiswa'     => $mahasiswa
            ], Response::HTTP_CREATED);
        } catch (QueryException $error) {
            return response()->json([
                'message'   => 'Something Wrong',
                'error'     => $error->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'fullname'  => ['required', 'string', 'max:200'],
            'username'  => ['required', 'string', 'max:100', 'unique:mahasiswas']
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $mahasiswa->update($request->all());
            return response()->json([
                'message'       => 'Data mahasiswa berhasil diubah',
                'mahasiswa'     => $mahasiswa
            ], Response::HTTP_OK);
        } catch (QueryException $error) {
            return response()->json([
                'message'   => 'Something Wrong',
                'error'     => $error->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function destroy(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        try {
            $mahasiswa->delete();
            return response()->json([
                'message'       => 'Berhasil dihapus'
            ], Response::HTTP_OK);
        } catch (QueryException $error) {
            return response()->json([
                'message'       => 'Berhasil dihapus',
                'error'         => $error->errorInfo
            ]);
        }
    }
}
