<?php

namespace CodeProject\Repositories;

use CodeProject\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeProject\Repositories\UserRepository;
use CodeProject\Entities\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public function presenter()
    {
        return UserPresenter::class;
    }
}
