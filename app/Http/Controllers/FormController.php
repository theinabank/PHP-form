<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('form');
    }

    public function validateForm(Request $request)
    {
        $error = [];
        if (!$request->name) {
            $error['error_name'] = 'Vārda lauks nevar būt tukšs';
        }

        if (!$request->surname) {
            $error['error_surname'] = 'Uzvārda lauks nevar būt tukšs';
        }

        if (!$request->date) {
            $error['error_date'] = 'Datuma lauks nevar būt tukšs';
        } else {
            if (strtotime(date('d-m-yy')) - strtotime($request->date) <= 18*365*24*60*60) {
                $error['error_date'] = 'Jums jābūt 18 gadu vecam';
            }
        }

        /**
         *check if file exists
         */
        if (!isset($_FILES['file'])) {
            $error['error_file'] = 'Pievienojiet bildi(jpg, png)';
        } else {
        /**
         *check file type
         */
            if (!in_array(@exif_imagetype($_FILES['file']['tmp_name']), array(1, 2, 3))) {
                $error['error_file'] = 'Pievienojiet bildi(jpg, png, gif)';
            }
        }

        if ($error) {
            return view('form', [
                'error' => $error
            ]);
        }

        $data = [
            'name' => $request->name,
            'surname' => $request->surname,
            'date' => $request->date,
            'file' => $_FILES['file']['tmp_name']
        ];

        $data = json_encode($data);

        $stream = fopen(md5($request->name.$request->surname).'.json', 'w');

        fwrite($stream, $data);

        return view('success', [
            'name' => $request->name,
            'surname' => $request->surname
        ]);

    }

    public function success()
    {
        return view('success');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
