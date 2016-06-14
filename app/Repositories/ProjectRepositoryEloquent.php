<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\Project;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ProjectPresenter;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    public function model()
    {
        return Project::class;
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }

    public function findWithOwnerAndMember($userId)
    {
        return $this->scopeQuery(function ($query) use ($userId) {
           return $query->select('projects.*')
               ->leftJoin('project_members','project_members.project_id','=','projects.id')
               ->where('project_members.user_id','=',$userId)
               ->union($this->model->query()->getQuery()->where('owner_id','=',$userId));
        })->all();
    }

}
