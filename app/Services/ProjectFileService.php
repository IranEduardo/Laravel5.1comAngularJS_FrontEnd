<?php


namespace CodeProject\Services;


use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectFileValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

use \Illuminate\Database\QueryException;


class ProjectFileService
{

   protected $repository;
   protected $projectRepository;
   protected $validator;
   protected $filesystem;
   protected $storage;


   public function __construct(ProjectFileRepository $repository, ProjectFileValidator $validator,
                               ProjectRepository $projectRepository,
                               Filesystem $filesystem, Storage $storage)
   {
        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
   }

    public function create(Array $data)
    {
        try {
              $this->validator->with($data)->passesOrFail();
              $project = $this->projectRepository->skipPresenter()->find($data['project_id']);
              $projectFile =  $project->files()->create($data);

        } catch(ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

       $this->storage->put($projectFile->id.".".$projectFile->extension,$this->filesystem->get($data['file']));

       return ['error' => 'false', 'message' => 'success'];
    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();

            $this->repository->skipPresenter()->update($data, $id);

        } catch(ValidatorException $e) {

            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

        return ['error' => 'false', 'message' => 'success'];
    }

    public function destroy($id)
    {
        try {
              $projectFile = $this->repository->skipPresenter()->find($id);

        } catch(ModelNotFoundException $e) {

            return response()->json([
                'error' => true,
                'message' => 'Arquivo não encontrado'
            ]);
        }

        if($this->storage->exists($projectFile->id . "." . $projectFile->extension)) {
            $this->storage->delete($projectFile->id . "." . $projectFile->extension);
            $projectFile->delete();
        }


        return response()->json(['error' => false, 'message' => 'success']);
    }

    public function getFilePath($id) {

        $projectFile = $this->repository->skipPresenter()->find($id);
        return $this->getBaseUrl($projectFile);
    }

    private function getBaseUrl($projectFile){

        switch ($this->storege->getDefaultDriver()){

            case 'local':
                return $this->storege->getDriver()->getAdapter()->getPathPrefix()
                .'/'.$projectFile->id . '.' . $projectFile->extension;
        }
    }

}