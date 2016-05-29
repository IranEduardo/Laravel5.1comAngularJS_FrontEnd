<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use CodeProject\Entities\ProjectFile;

/**
 * Class ProjectFileTransformer
 * @package namespace CodeProject\Transformers;
 */
class ProjectFileTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjectFile entity
     * @param \ProjectFile $model
     *
     * @return array
     */
    public function transform(ProjectFile $projectFile)
    {
        return ['id' => $projectFile->id,
                'description' => $projectFile->description,
                'name' => $projectFile->name,
                'project_id' => $projectFile->project_id
        ];
    }
}
