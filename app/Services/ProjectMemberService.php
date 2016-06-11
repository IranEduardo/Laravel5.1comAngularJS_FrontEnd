<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProjectMemberService
{

   protected $repository;
   protected $validator;

   protected $repository_project;

   public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator, ProjectRepository $repository_project)
   {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->repository_project = $repository_project;
   }

   public function create(array $data)
   {
       try {
           $this->validator->with($data)->passesOrFail();

           $this->repository_project->skipPresenter()->find($data['project_id'])->members()->attach($data['user_id']);

       } catch(ValidatorException $e) {

           return [
               'error' => true,
               'message' => $e->getMessageBag()
           ];
       }
       return ['error' => false, 'message' => 'success'];
   }
   public function update(array $data, $id, $idMember)
   {
       try {
            $project = $this->repository_project->skipPresenter()->find($id);
            $project->members()->updateExistingPivot($idMember, ['user_id' => $data['user_id']]);
       }
       catch(\Exception $e)
       {
           return response()->json(['error' => true,
               'message' => $e->getMessage()]);
       }
       return ['error' => false, 'message' => 'success'];
   }

   public function show($id, $idMember)
   {
        try {
             $member = $this->repository->skipPresenter()->findWhere(['project_id' => $id, 'user_id' => $idMember]);
             if (isset($member) && (count($member) > 0)) {
                 return $member[0];
             }

        }
        catch(\Exception $e)
        {
            return response()->json(['error' => true,
                                     'message' => $e->getMessage()]);
        }
   }

   public function index($id)
   {
        try {
            return $this->repository->findWhere(['project_id' => $id]);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }

   }

   public function destroy($id, $idMember)
   {
        try {

            $this->repository_project->skipPresenter()->find($id)->members()->detach($idMember);

        } catch (\Exception $e) {

            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
        return ['error' => false, 'message' => 'success'];
   }

}