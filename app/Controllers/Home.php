<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct() {
        $this->auth = service('auth');
    }
    public function index(): string
    {
        // if (auth()->loggedIn()) {
            redirect()->to(config('Auth')->loginRedirect());
        // }
        // if (!$this->auth->loggedIn()) {
        //     redirect(config('Auth')->loginRedirect());
        // } else {
        //     redirect(base_url().'profile');
        // }
        return view('welcome_message');
    }
}
