<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userRepository->getAllUsers();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $this->userRepository->createUser($data);

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = $this->userRepository->getUserById($id);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();
        
        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }

        $this->userRepository->updateUser($id, $data);

        return redirect()->route('users.index');
    }

    /**
     * Deactivate the specified resource in storage.
     */
    public function deactivate($id, $status)
    {
        $status = $status=='A' ? 'I' : 'A';
        $this->userRepository->updateUser($id, ['status' => $status]);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->userRepository->deleteUser($id);
        return redirect()->route('users.index');
    }
}
