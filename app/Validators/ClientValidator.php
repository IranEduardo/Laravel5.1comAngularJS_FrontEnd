<?php
/**
 * Created by PhpStorm.
 * User: Segredo
 * Date: 18/10/2015
 * Time: 01:22
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{

    protected $rules = [

        'name'        => 'required|max:255',
        'responsible' => 'required|max:255',
        'email'       => 'required|email',
        'phone'       => 'required',
        'address'     => 'required'
    ];
}