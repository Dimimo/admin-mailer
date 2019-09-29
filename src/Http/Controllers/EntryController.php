<?php

namespace Dimimo\AdminMailer\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

/**
 * Class EntryController
 * @package Dimimo\AdminMailer\Http\Controllers
 */
class EntryController extends Controller
{
    use ValidatesRequests;

    /**
     * @var Request $request
     */
    protected $request;

    /**
     * EntryController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}

