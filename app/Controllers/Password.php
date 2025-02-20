<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Password extends Controller
{
    public function resetRequest()
    {
        $email = $this->request->getPost('email');
        $userModel = model('UserModel');
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Send reset link via email (implement email sending)
            // For simplicity, we just log a message here
            log_message('info', 'Password reset link sent to ' . $email);
        }

        return redirect()->to('/')->with('message', 'If the email is registered, a reset link will be sent.');
    }

    public function reset()
    {
        $token = $this->request->getPost('token');
        $newPassword = $this->request->getPost('new_password');
        $userModel = model('UserModel');

        // Validate token and reset password
        // For simplicity, token validation is skipped here
        $user = $userModel->where('reset_token', $token)->first();

        if ($user) {
            $userModel->update($user['id'], [
                'password' => password_hash($newPassword, PASSWORD_DEFAULT),
                'reset_token' => null // Clear reset token
            ]);

            return redirect()->to('/login')->with('success', 'Password reset successfully.');
        }

        return redirect()->to('/')->with('error', 'Invalid token.');
    }
}