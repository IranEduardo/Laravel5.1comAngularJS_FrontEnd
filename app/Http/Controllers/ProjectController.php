<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $repository;

    private $service;


    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service    = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->repository->all();
    }


    public function store(Request $request)
    {
        return  $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return $this->service->show($id);
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
        if (($this->service->checkProjectPermissions(($id))) == false)
            return ['error' => 'Access Forbidden'];

        return $this->service->update($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (($this->service->checkProjectOwner(($id))) == false)
            return ['error' => 'Access Forbidden'];

        return $this->service->destroy($id);
    }

    public function store_member(Request $request)
    {
        if (($this->service->checkProjectOwner(($request['project_id']))) == false)
            return ['error' => 'Access Forbidden'];

        return $this->service->addMember($request->all());
    }

    public function destroy_member($id, $idUser)
    {
        if (($this->service->checkProjectOwner(($id))) == false)
            return ['error' => 'Access Forbidden'];

       return $this->service->removeMember($id,$idUser);
    }

    public function index_members($id)
    {
        if (($this->service->checkProjectPermissions(($id))) == false)
            return ['error' => 'Access Forbidden'];

        return $this->repository->skipPresenter()->find($id)->members;
    }

}
