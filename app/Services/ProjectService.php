<?php


namespace CodeProject\Services;

use CodeProject\Entities\ProjectMember;
use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectMemberValidator;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use \Illuminate\Database\QueryException;


class ProjectService
{

   protected $repository;
   protected $validator;

   protected $validatormember;

   protected $filesystem;
   protected $storage;


   public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectMemberValidator $validatormember)
   {
        $this->repository = $repository;
        $this->validator = $validator;

        $this->validatormember  = $validatormember;

   }

   public function create(array $data)
   {
        try {
            $this->validator->with($data)->passesOrFail();
            $project =  $this->repository->skipPresenter()->create($data);
            $project->progress = (int)0;
            return $project;
        } catch(ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
   }

   public function update(array $data,$project)
   {
        try {
            $this->validator->with($data)->passesOrFail();
            try {
                $this->repository->skipPresenter()->update($data, $project);
            } catch (ModelNotFoundException $e) {

                return [
                    'error' => true,
                    'message' => 'Projeto Nao Existe'
                ];
            }
            return ['error' => false, 'message' => 'success'];
        } catch(ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
   }
    public function show($project)
    {
        try {
            return $this->repository->find($project);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['error' => true, 'message' => 'Project Nao Existe']);
        }

    }
    public function destroy($project)
    {
        try {
            $this->repository->skipPresenter()->delete($project);
            return ['error' => false, 'message' => 'success'];
        }
        catch(\Exception $e)
        {
            if ($e instanceof ModelNotFoundException)
                return response()->json(['error' => true, 'message' => 'Project Nao Existe']);
            elseif ($e instanceof QueryException)
                return response()->json(['error' => true, 'message' => 'Existe(m) Member(s) Atrelados a Esse Project']);
            else
                return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
  
   public function checkProjectMember($id)
   {
       try {
            $project = $this->repository->skipPresenter()->find($id);

       } catch (ModelNotFoundException $e) {

          return false;
       }

       $userId =  \Authorizer::getResourceOwnerId();

       foreach ($project->members as $member) {
           if ($member->id == $userId) {
               return true;
           }
       }
       return false;
   }
   public function checkProjectOwner($id)
   {
       try {
           $project = $this->repository->skipPresenter()->find($id);

       } catch (ModelNotFoundException $e) {

         return false;

       }
       $userId =  \Authorizer::getResourceOwnerId();

       if ($project->owner_id == $userId)
           return true;
       return false;
   }
   public function checkProjectPermissions($id)
   {
       if ($this->checkProjectMember($id) or $this->checkProjectOwner($id))
           return true;
       return false;
   }
}