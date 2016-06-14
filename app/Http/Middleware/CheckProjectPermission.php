<?php

namespace CodeProject\Http\Middleware;

use Closure;
use CodeProject\Services\ProjectService;

class CheckProjectPermission
{

    private $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    public function handle($request, Closure $next)
    {
        $projectId = $request->route('id') ? $request->route('id') : $request->route('project');
        if ($this->service->checkProjectPermissions($projectId) == false) {
            return ['error' => 'You haven\'t permission to acess project'];
        }

        return $next($request);

    }
}
