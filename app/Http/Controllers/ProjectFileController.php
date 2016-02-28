<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ProjectFileController extends Controller
{

    private $repository;

    private $service;


    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service    = $service;
    }

    public function store(Request $request)
    {
        if ($this->service->checkProjectPermissions($request->project_id) == false)
            return ['error' => 'Access Forbidden'];

       $file = $request->file('file');
       $extension = $file->getClientOriginalExtension();

       $data['file'] = $file;
       $data['name'] = $request->name;
       $data['project_id'] = $request->project_id;
       $data['description'] = $request->description;
       $data['extension'] = $extension;

       return  $this->service->createFile($data);
    }


    public function destroy($id,$idProjectFile)
    {
        if ($this->service->checkProjectPermissions($id) == false)
            return ['error' => 'Access Forbidden'];

        return $this->service->destroyFile($id, $idProjectFile);
    }

}
