<?php


namespace CodeProject\Services;

use CodeProject\Entities\ProjectMember;
use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectMemberValidator;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProjectService
{

   protected $repository;
   protected $validator;

   protected $repositorymember;
   protected $validatormember;


   public function __construct(ProjectRepository $repository, ProjectValidator $validator,  ProjectMemberRepository $repositorymember, ProjectMemberValidator $validatormember)
   {
        $this->repository = $repository;
        $this->validator = $validator;

        $this->repositorymember = $repositorymember;
        $this->validatormember  = $validatormember;
   }

   public function create(array $data)
   {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch(ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
   }

   public function update(array $data,$id)
   {
        try {
            $this->validator->with($data)->passesOrFail();
            try {
                $this->repository->update($data, $id);
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
    public function show($id)
    {
        try {
            return $this->repository->with(['owner', 'client'])->find($id);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['error' => true, 'message' => 'Project Nao Existe']);
        }

    }
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return ['error' => false, 'message' => 'success'];
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['error' => true, 'message' => 'Project Nao Existe']);
        }
    }

    public function addMember(array $data)
    {
        try {
            $this->validatormember->with($data)->passesOrFail();

            $this->repository->find($data['project_id'])->members()->attach($data['user_id']);


        } catch(ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
        return ['error' => false, 'message' => 'success'];
    }

    public function removeMember($id, $idUser)
    {
        try {

            $this->repository->find($id)->members()->detach($idUser);

        } catch (\Exception $e) {

            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
        return ['error' => false, 'message' => 'success'];
    }

   public function isMember($id, $idUser)
   {
       try {
           $this->repositorymember->findWhere(['project_id' => $id, 'user_id' => $idUser]);

       } catch (ModelNotFoundException $e) {
               return [
                   'error' => true,
                   'message' => $e->getMessageBag()
               ];
       }
       return ['error' => false, 'message' => 'success'];
   }

}