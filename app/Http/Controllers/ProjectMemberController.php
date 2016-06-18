<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Services\ProjectMemberService;
use CodeProject\Services\ProjectService;
use CodeProject\Validators\ProjectMemberValidator;
use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ProjectMemberController extends Controller
{

    private $validator;
    private $service;
    private $service_project;


    public function __construct(ProjectMemberService $service, ProjectMemberValidator $validator, ProjectService $service_project)
    {
        $this->service = $service;
        $this->validator = $validator;
        $this->service_project = $service_project;
        $this->middleware('check.project.owner', ['except' => ['index','show']]);
        $this->middleware('check.project.permission', ['except' => ['store','destroy']]);

    }

    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['project_id'] = $id;
        return $this->service->create($data);
    }

    public function show($id, $idMember)
    {
        return $this->service->show($id, $idMember);
    }

    public function destroy($id, $idMember)
    {
        if (($this->service_project->checkProjectOwner(($id))) == false)
            return ['error' => 'Access Forbidden'];

        return $this->service->destroy($id, $idMember);
    }

    public function index($id)
    {
        return $this->service->index($id);
    }

}
