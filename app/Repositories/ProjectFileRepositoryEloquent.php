<?php

namespace CodeProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Entities\ProjectFile;
use CodeProject\Presenters\ProjectFilePresenter;

/**
 * Class ProjectNoteRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectFile::class;
    }


    public function presenter()
    {
        return ProjectFilePresenter::class;
    }


}

