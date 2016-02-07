<?php
/**
 * Created by PhpStorm.
 * User: Segredo
 * Date: 18/10/2015
 * Time: 01:22
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{

    protected $rules = [
         'project_id' =>  'required',
         'title'      =>  'required|max:255',
         'note'       =>  'required'
    ];
}