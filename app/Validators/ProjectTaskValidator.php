<?php
/**
 * Created by PhpStorm.
 * User: Segredo
 * Date: 18/10/2015
 * Time: 01:22
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{

    protected $rules = [
        'name'        => 'required|max:255',
        'project_id'  => 'required|integer',
        'start_date'  => 'required|date',
        'due_date'    => 'required|date',
        'status'      => 'required|integer',
    ];
}