<?php

namespace CodeProject\Http\Middleware;

use Closure;
use CodeProject\Services\ProjectService;

class CheckProjectOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    public function handle($request, Closure $next)
    {
        $projectId = $request->route('id') ? $request->route('id') : $request->route('project');
        if ($this->service->checkProjectOwner($projectId) == false) {
            return response('You haven\'t permission to access project',403); //return ['error' => 'Access forbidden'];
        }
        
        return $next($request);
    }
}
