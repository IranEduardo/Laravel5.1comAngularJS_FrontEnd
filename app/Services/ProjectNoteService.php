<?php


namespace CodeProject\Services;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProjectNoteService
{

   protected $repository;
   protected $validator;

   public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
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

   public function update(array $data,$idNote)
   {
        try {
            $this->validator->with($data)->passesOrFail();
            try {
                $this->repository->skipPresenter()->update($data, $idNote);
            } catch (ModelNotFoundException $e) {

                return [
                    'error' => true,
                    'message' => 'Nota Nao Existe'
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
    public function show($id, $idNote)
    {
        try {
            return $this->repository->skipPresenter()->findWhere(['project_id' => $id, 'id' => $idNote]);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['error' => true, 'message' => 'Nota Nao Existe']);
        }

    }

    public function index($id)
    {
        try {
            return $this->repository->skipPresenter()->findWhere(['project_id' => $id]);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['error' => true, 'message' => 'Nota(s) Nao Existe(m)']);
        }

    }


    public function destroy($idNote)
    {
        try {
            $this->repository->skipPresenter()->delete($idNote);
            return ['error' => false, 'message' => 'success'];
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['error' => true, 'message' => 'Nota Nao Existe']);
        }
    }

}