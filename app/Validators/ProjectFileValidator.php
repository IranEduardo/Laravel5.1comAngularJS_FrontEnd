<?php

namespace CodeProject\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'project_id'  => 'required|integer|exists:projects,id',
            'name'        => 'required|max:255',
            'description' => 'required|max:255',
            'file'        => 'required|mimes:jpeg,jpg,png,gif,pdf,zip'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'project_id'  => 'required|integer|exists:projects,id',
            'name'        => 'required|max:255',
            'description' => 'required|max:255',
        ],
    ];

}