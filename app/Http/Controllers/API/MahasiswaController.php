<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;
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
}
