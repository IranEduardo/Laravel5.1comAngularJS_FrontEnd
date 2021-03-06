<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Services\ProjectFileService;

use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function show($id, $idFile)
    {
        return $this->repository->find($idFile);
    }

    public function store(Request $request, $id)
    {
       $projectFile = $request->file('file');

       $data['file'] = $projectFile;
       $data['name'] = $request->name;
       $data['project_id'] = $id;
       $data['description'] = $request->description;
       $data['extension'] = $projectFile->getClientOriginalExtension();

       return  $this->service->create($data);
    }

    public function showFile($id, $idFile) {

        try {
            $projectFile = $this->repository->skipPresenter()->find($idFile);
        }
        catch (ModelNotFoundException $e) {
            return ['error' => 'true', 'message' => 'Arquivo de Projeto não encontrado'];
        };

        $filePath = $this->service->getFilePath($idFile);
        $fileContent = file_get_contents($filePath);
        $file64 = base64_encode($fileContent);
        return [
            'file' => $file64,
            'size' => filesize($filePath),
            'name' => $this->service->getFileName($idFile)
        ];
    }

    public function update($id, $idFile, Request $request)
    {
       return  $this->service->update($request->all(),$idFile);
    }


    public function destroy($id,$idFile)
    {
        return $this->service->destroy($idFile);
    }
}
