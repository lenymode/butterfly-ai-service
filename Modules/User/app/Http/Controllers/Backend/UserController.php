<?php

namespace Modules\User\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Services\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->getPaginatedUsers();
        return view('user::index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->userService->createUser($request->validated());
        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return view('user::show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {$user = $this->userService->getUserById($id);
        return view('user::edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {$this->userService->updateUser($id, $request->validated());
        return redirect()->route('user.show', $id)->with('success', 'User updated successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}
