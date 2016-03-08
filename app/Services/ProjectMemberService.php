<?php


namespace CodeProject\Services;

use CodeProject\Repositories\ProjectMemberRepository;
use CodeProject\Validators\ProjectMemberValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProjectMemberService
{

   protected $repository;
   protected $validator;

   public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator)
   {
        $this->repository = $repository;
        $this->validator = $validator;
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
                $this->repository->skipPresenter()->update($data, $id);
            } catch (ModelNotFoundException $e) {

                return [
                    'error' => true,
                    'message' => 'Membro Nao Existe'
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
            return $this->repository->skipPresenter()->find($id);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['error' => true, 'message' => 'Membro Nao Existe']);
        }

    }
    public function destroy($id)
    {
        try {
            $this->repository->skipPresenter()->delete($id);
            return ['error' => false, 'message' => 'success'];
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['error' => true, 'message' => 'Membro Nao Existe']);
        }
    }

}