<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectMember;
use League\Fractal\TransformerAbstract;


class ProjectMemberTransformer extends TransformerAbstract
{
    public function transform(ProjectMember $projectMember)
    {
       return  $projectMember;

    }

}