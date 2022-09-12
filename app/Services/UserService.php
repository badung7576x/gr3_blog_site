<?php

namespace App\Services;

use App\Models\Group;
use App\Models\User;

class UserService
{
  public function getAllUsers()
  {
    return User::where('group_id', '!=', ROLE_ADMIN)->latest()->get();
  }

  public function getListReviewer()
  {
    return User::where('group_id', ROLE_REVIEWER)->orderBy('id')->get();
  }

  public function getGroupUsers()
  {
    return Group::where('id', '!=', ROLE_ADMIN)->orderBy('id', 'asc')->get();
  }

  public function createNewUser(array $data)
  {
    if (isset($data['image'])) {
      $uploadImageService = new UploadImageService();
      $data['profile_image'] = $uploadImageService->upload($data['image']->get())['url'];
    }

    return User::create($data);
  }

  public function updateUser(User $user, array $data)
  {
    if (!$data['password']) unset($data['password']);
    
    if(isset($data['image'])){
      $uploadImageService = new UploadImageService();
      $data['profile_image'] = $uploadImageService->upload($data['image']->get())['url'];
    }

    return $user->update($data);
  }

  public function delete(User $user)
  {
    return $user->delete();
  }
}
