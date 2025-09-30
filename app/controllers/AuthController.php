<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: AuthController
 * 
 * Automatically generated via CLI.
 */
class AuthController extends Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->call->model('StudentsModel');
        $this->call->library('session');
    }
    
    public function login()
    {
        // Handle POST request for login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $errors = [];
            
            // Validate input
            if (empty($email)) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Please enter a valid email address';
            }
            
            if (empty($password)) {
                $errors['password'] = 'Password is required';
            }
            
            if (empty($errors)) {
                // Find user by email
                $user = $this->StudentsModel->find_by_email($email);
                
                if ($user && $this->StudentsModel->verify_password($password, $user['password'])) {
                    // Login successful
                    $this->session->set_userdata([
                        'user_id' => $user['id'],
                        'user_email' => $user['email'],
                        'user_name' => $user['first_name'] . ' ' . $user['last_name'],
                        'logged_in' => true
                    ]);
                    
                    // Redirect to dashboard or users page
                    redirect('/users');
                } else {
                    $errors['login'] = 'Invalid email or password';
                }
            }
            
            // If there are errors, pass them to the view
            $this->call->view('login', ['errors' => $errors, 'old_email' => $email]);
        } else {
            // Show login form
            $this->call->view('login');
        }
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/login');
    }
    
    public function is_logged_in()
    {
        return $this->session->userdata('logged_in') === true;
    }
    
    public function require_auth()
    {
        if (!$this->is_logged_in()) {
            redirect('/login');
        }
    }
    
    public function register()
    {
        // Handle POST request for registration
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
            $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
            $errors = [];
            
            // Validate input
            if (empty($first_name)) {
                $errors['first_name'] = 'First name is required';
            } elseif (strlen($first_name) < 2) {
                $errors['first_name'] = 'First name must be at least 2 characters';
            }
            
            if (empty($last_name)) {
                $errors['last_name'] = 'Last name is required';
            } elseif (strlen($last_name) < 2) {
                $errors['last_name'] = 'Last name must be at least 2 characters';
            }
            
            if (empty($email)) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Please enter a valid email address';
            } elseif ($this->StudentsModel->email_exists($email)) {
                $errors['email'] = 'Email address already exists';
            }
            
            if (empty($password)) {
                $errors['password'] = 'Password is required';
            } elseif (strlen($password) < 6) {
                $errors['password'] = 'Password must be at least 6 characters';
            }
            
            if (empty($confirm_password)) {
                $errors['confirm_password'] = 'Please confirm your password';
            } elseif ($password !== $confirm_password) {
                $errors['confirm_password'] = 'Passwords do not match';
            }
            
            if (empty($errors)) {
                // Create new user
                $user_data = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'password' => $password
                ];
                
                $user_id = $this->StudentsModel->create_student($user_data);
                
                if ($user_id) {
                    // Registration successful, redirect to login
                    redirect('/login');
                } else {
                    $errors['registration'] = 'Registration failed. Please try again.';
                }
            }
            
            // If there are errors, pass them to the view
            $this->call->view('register', [
                'errors' => $errors, 
                'old_data' => [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email
                ]
            ]);
        } else {
            // Show registration form
            $this->call->view('register');
        }
    }
}