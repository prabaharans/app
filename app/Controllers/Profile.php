<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Profile extends Controller
{
    public function index()
    {
        $userModel = model('UserModel');
        $userId = auth()->id(); // Get current user ID
        $data['user'] = $userModel->find($userId);
        // echo '<pre>';
        // print_r($data);
        // print_r($userId);
        // echo '</pre>';
        // die;
        return view('profile_view', $data);
    }

    public function update()
    {
        $userModel = model('UserModel');
        $userId = auth()->id(); // Get current user ID

        $userModel->update($userId, [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ]);

        return redirect()->to('/profile')->with('success', 'Profile updated successfully.');
    }
}