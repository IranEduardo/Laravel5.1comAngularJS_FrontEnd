<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Services\ProjectFileService;

use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ProjectFileController extends Controller
{

    private $repository;
    private $service;

    private $project_repository;
    private $project_service;


    public function __construct(ProjectFileRepository $repository, ProjectFileService $service,
                                ProjectRepository $project_repository, ProjectService $project_service)
    {
        $this->repository = $repository;
        $this->service    = $service;

        $this->project_repository = $project_repository;
        $this->project_service    = $project_service;
    }

    public function index($id) {

        return $this->repository->findWhere(['project_id' => $id]);
    }

    public function show($id, $idFile) {

        if ($this->project_service->checkProjectPermissions($id) == false)
            return ['error' => 'Access Forbidden'];


        return $this->repository->skipPresenter()->find($idFile);
    }


    public function store(Request $request)
    {
        if ($this->project_service->checkProjectPermissions($request->project_id) == false)
            return ['error' => 'Access Forbidden'];

       $projectFile = $request->file('file');

       $data['file'] = $projectFile;
       $data['name'] = $request->name;
       $data['project_id'] = $request->project_id;
       $data['description'] = $request->description;
       $data['extension'] = $projectFile->getClientOriginalExtension();

       return  $this->service->create($data);
    }

    public function showFile($id, $idFile) {

        if ($this->project_service->checkProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }
        return response()->download($this->service->getFilePath($idFile));
    }

    public function update($id, $idFile, Request $request)
    {
        if ($this->project_service->checkProjectPermissions($id) == false)
            return ['error' => 'Access Forbidden'];

        return  $this->service->update($request->all(),$idFile);
    }


    public function destroy($id,$idFile)
    {
        if ($this->project_service->checkProjectPermissions($id) == false)
            return ['error' => 'Access Forbidden'];

        return $this->service->destroy($idFile);
    }
}
