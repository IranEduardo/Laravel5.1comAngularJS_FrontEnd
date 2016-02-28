<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;


class ProjectTaskTransformer extends TransformerAbstract
{
    public function transform(ProjectTask $projectTask)
    {
       return $projectTask;
    }
}