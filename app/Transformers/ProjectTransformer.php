<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;


class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'members','client','tasks'
    ];


    public function transform(Project $project)
    {
       return [
                  'id'          => $project->id,
                  'owner_id'    => $project->owner_id,
                  'client_id'   => $project->client_id,
                  'name'        => $project->name,
                  'description' => $project->description,
                  'progress'    => (int) $project->progress,
                  'status'      => $project->status,
                  'due_date'    => $project->due_date,
                  'is_member'   => $project->owner_id != \Authorizer::getResourceOwnerId()
               ];
    }

    public function includeClient(Project $project)
    {
        $client = $project->client;

        return $this->item($client, new ClientTransformer());
    }

    public function includeMembers(Project $project)
    {
        $members = $project->members;

        return $this->collection($members, new UserTransformer());
    }

    public function includeTasks(Project $project)
    {
        $tasks = $project->tasks;

        return $this->collection($tasks, new ProjectTaskTransformer());
    }

}