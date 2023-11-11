<?php

namespace Vanguard\Http\Controllers\Web\Profile;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\User\UpdateProfileLoginDetailsRequest;
use Vanguard\Repositories\User\UserRepository;

/**
 * Class LoginDetailsController
 * @package Vanguard\Http\Controllers
 */
class LoginDetailsController extends Controller
{
    public function __construct(private UserRepository $users)
    {
    }

    /**
     * Update user's login details.
     *
     * @param UpdateProfileLoginDetailsRequest $request
     * @return mixed
     */
    public function update(UpdateProfileLoginDetailsRequest $request)
    {
        $data = $request->except('role', 'status');

        // If password is not provided, then we will
        // just remove it from $data array and do not change it
        if (! data_get($data, 'password')) {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        $this->users->update(auth()->id(), $data);

        return redirect()->route('profile')
            ->withSuccess(__('Login details updated successfully.'));
    }
}
