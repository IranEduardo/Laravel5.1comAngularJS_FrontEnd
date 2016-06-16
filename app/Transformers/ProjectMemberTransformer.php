<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectMember;
use League\Fractal\TransformerAbstract;


class ProjectMemberTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'user'
    ];

    public function transform(ProjectMember $projectMember)
    {
       return  [
                 'project_id' => $projectMember->project_id,
                 'user_id'    => $projectMember->user_id
       ];
    }

    public function includeUser(ProjectMember $projectMember)
    {
        return $this->item($projectMember->user, new UserTransformer());
    }

}