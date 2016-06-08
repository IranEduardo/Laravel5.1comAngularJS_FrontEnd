<?php

namespace CodeProject\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'        => 'required|max:255',
            'description' => 'required|max:255',
            'file'        => 'required|mimes:jpeg,jpg,png,gif,pdf,zip'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'        => 'required|max:255',
            'description' => 'required|max:255',
        ],
    ];

}