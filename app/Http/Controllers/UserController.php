<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use CodeProject\Repositories\UserRepository;


class UserController extends Controller
{

    private $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function authenticated()
    {
        $userId = Authorizer::getResourceOwnerId();
        return $this->repository->skipPresenter()->find($userId);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return $this->repository->all();
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
