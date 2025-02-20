<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Account extends Controller
{
    public function activate($token)
    {
        $userModel = model('UserModel');
        $user = $userModel->where('activation_token', $token)->first();

        if ($user) {
            $userModel->update($user['id'], [
                'is_active' => true,
                'activation_token' => null // Clear activation token
            ]);

            return redirect()->to('/login')->with('success', 'Account activated successfully.');
        }

        return redirect()->to('/')->with('error', 'Invalid activation token.');
    }

    public function deactivate()
    {
        $userId = auth()->id(); // Get current user ID
        $userModel = model('UserModel');

        $userModel->update($userId, [
            'is_active' => false
        ]);

        return redirect()->to('/login')->with('success', 'Account deactivated. Please contact support to reactivate.');
    }
}