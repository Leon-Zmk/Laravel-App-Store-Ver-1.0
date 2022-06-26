<?php

namespace App\Http\Controllers;

use App\Models\MediaLibrary;
use App\Http\Requests\StoreMediaLibraryRequest;
use App\Http\Requests\UpdateMediaLibraryRequest;


class MediaLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreMediaLibraryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMediaLibraryRequest $request)
    {   

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MediaLibrary  $mediaLibrary
     * @return \Illuminate\Http\Response
     */
    public function show(MediaLibrary $mediaLibrary)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MediaLibrary  $mediaLibrary
     * @return \Illuminate\Http\Response
     */
    public function edit(MediaLibrary $mediaLibrary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMediaLibraryRequest  $request
     * @param  \App\Models\MediaLibrary  $mediaLibrary
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMediaLibraryRequest $request, MediaLibrary $mediaLibrary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MediaLibrary  $mediaLibrary
     * @return \Illuminate\Http\Response
     */
    public function destroy(MediaLibrary $mediaLibrary)
    {
        //
    }
}
