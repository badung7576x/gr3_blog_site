<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Traits\ResponseTrait;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use ResponseTrait;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groupUsers = $this->userService->getGroupUsers();

        return view('admin.users.create', compact('groupUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();

        try {
            $this->userService->createNewUser($data);
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->redirectError('Đã xảy ra lỗi trong quá trình tạo người dùng, vui lòng thử lại sau.');
        }

        return $this->redirectSuccess('admin.user.index', 'Tạo người dùng thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $groupUsers = $this->userService->getGroupUsers();

        return view('admin.users.edit', compact('groupUsers', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $data = $request->validated();

        try {
            $this->userService->updateUser($user, $data);
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->redirectError('Đã xảy ra lỗi trong quá trình cập nhật thông tin người dùng, vui lòng thử lại sau.');
        }

        return $this->redirectSuccess('admin.user.index', 'Cập nhật thông tin người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $this->userService->delete($user);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->redirectError('Không thể xóa được người dùng, vui lòng thử lại sau.');
        }

        return $this->redirectSuccess('admin.user.index', 'Xóa người dùng thành công');
    }
}
