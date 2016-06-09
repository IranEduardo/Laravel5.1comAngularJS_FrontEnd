<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Services\ProjectTaskService;
use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ProjectTaskController extends Controller
{
    /**
     * @var ProjectTaskRepository
     */
    private $repository;

    private $service;


    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service    = $service;
    }


    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return  $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $idTask
     * @return \Illuminate\Http\Response
     */
    public function show($id, $idTask)
    {
       return $this->service->show($id, $idTask);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $idTask)
    {
        return $this->service->update($request->all(),$idTask);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idTask)
    {
        return $this->service->destroy($idTask);
    }

    public function index($id)
    {
       return $this->service->index($id);
    }

}
