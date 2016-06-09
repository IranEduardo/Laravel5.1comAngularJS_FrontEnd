<?php


namespace CodeProject\Services;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProjectTaskService
{

   protected $repository;
   protected $validator;

   public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
   {
        $this->repository = $repository;
        $this->validator = $validator;
   }

   public function create(array $data)
   {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->skipPresenter()->create($data);
        } catch(ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
   }

   public function update(array $data,$idTask)
   {
        try {
            $this->validator->with($data)->passesOrFail();
            try {
                $this->repository->skipPresenter()->update($data, $idTask);
            } catch (ModelNotFoundException $e) {

                return [
                    'error' => true,
                    'message' => 'Task Nao Existe'
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
    public function show($id, $idTask)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id, 'id' => $idTask]);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['error' => true, 'message' => 'Task Nao Existe']);
        }

    }
    public function destroy($idTask)
    {
        try {
            $this->repository->skipPresenter()->delete($idTask);
            return ['error' => false, 'message' => 'success'];
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['error' => true, 'message' => 'Task Nao Existe']);
        }
    }

    public function index($id)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id]);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['error' => true, 'message' => 'Task(s) Nao Existe(m)']);
        }

    }

}