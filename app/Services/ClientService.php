<?php

namespace CodeProject\Services;


use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ClientService
{
    protected $repository;
    protected $validator;

    public function __construct(ClientRepository $repository, ClientValidator $validator)
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

    public function update(array $data,$id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            try {
                $this->repository->skipPresenter()->update($data, $id);
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
            return $this->repository->skipPresenter()->find($id);
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json(['error' => true, 'message' => 'Client Nao Existe']);
        }

    }
    public function destroy($id)
    {
        try {
            $this->repository->skipPresenter()->delete($id);
            return ['error' => false, 'message' => 'success'];
        }
        catch(\Exception $e)
        {
            if ($e instanceof ModelNotFoundException)
               return response()->json(['error' => true, 'message' => 'Client Nao Existe']);
            elseif ($e instanceof QueryException)
               return response()->json(['error' => true, 'message' => 'Existe(m) Project(s) Atrelados a Esse Client']);
            else
               return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
}