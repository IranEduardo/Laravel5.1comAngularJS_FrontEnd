<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;


class ProjectNoteTransformer extends TransformerAbstract
{
    public function transform(ProjectNote $projectNote)
    {
      return $projectNote;
    }
}