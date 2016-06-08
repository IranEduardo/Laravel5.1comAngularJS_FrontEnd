<?php
/**
 * Created by PhpStorm.
 * User: Segredo
 * Date: 18/10/2015
 * Time: 01:22
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectMemberValidator extends LaravelValidator
{

    protected $rules = [
        'user_id'     => 'required|integer|exists:users,id'
    ];
}