<?php


namespace CodeProject\Services;

use CodeProject\Entities\ProjectMember;
use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectMemberValidator;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;



class ProjectService
{

   protected $repository;
   protected $validator;

   protected $validatormember;

   protected $filesystem;
   protected $storage;


   public function __construct(ProjectRepository $repository, ProjectValidator $validator, ProjectMemberValidator $validatormember, Filesystem $filesystem, Storage $storage)
   {
        $this->repository = $repository;
        $this->validator = $validator;

        $this->validatormember  = $validatormember;

        $this->filesystem = $filesystem;
        $this->storage = $storage;
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

   public function checkProjectMember($id)
   {
       $project = $this->repository->skipPresenter()->find($id);
       $userId =  \Authorizer::getResourceOwnerId();

       foreach ($project->members as $member) {
           if ($member->user_id == $userId)
               return true;
       }
       return false;
   }
   public function checkProjectOwner($id)
   {
       $project = $this->repository->skipPresenter()->find($id);
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

    public function createFile(Array $data)
    {
       $project = $this->repository->skipPresenter()->find($data['project_id']);
       $projectFile =  $project->files()->create($data);

       $this->storage->put($projectFile->id.".".$data['extension'],$this->filesystem->get($data['file']));

       return ['error' => 'false', 'message' => 'success'];
    }

    public function destroyFile($id, $idProjectFile)
    {
        $project = $this->repository->skipPresenter()->find($id);

        $ProjectFiles =  $project->files;

        $extension = '';

        foreach ($ProjectFiles as $projectFile)
        {
           if ($projectFile->id == $idProjectFile)
           {
               $extension =  $projectFile->extension;
               $projectFile->delete();

              /* try {

                  $extension =  $projectFile->extension;
                  $projectFile->delete();

               } catch (ModelNotFoundException $e) {

                 return response()->json(['error' => true, 'message' => 'Arquivo Nao Existe']);

               } */
           }
        }

        if ($extension)
          $this->storage->delete($idProjectFile.".".$extension);

        return response()->json(['error' => false, 'message' => 'success']);

    }
}