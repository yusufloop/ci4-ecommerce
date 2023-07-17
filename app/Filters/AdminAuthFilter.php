<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use IonAuth\Libraries\IonAuth;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here

        $auth= new IonAuth();

        if(!$auth->loggedIn())
        {
            return redirect()->to('/auth/login');
        }
        
        $currentUser = $auth->user()->row();
        
       
        if(!$auth->inGroup($arguments, $currentUser->id))
        {
            session()->setFlashdata('errors', "Sorry, You don't have the access to requested page");
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}