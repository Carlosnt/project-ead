<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Services\UploadFile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('admin.profile.edit');
    }

    public function uploadFile(Request $request, UploadFile $uploadFile, $id)
    {
        $userUpdate = $request->user();
        dd($userUpdate);
      
        if($request->hasFile('image')){
            if ($userUpdate->image != null) {             
                $uploadFile->removeFile($userUpdate->image);
                $userUpdate->image = '';
                $userUpdate->save();
            }
        }        

        $path = $uploadFile->store($request->image, 'users');

        /*if(!$this->service->update($id, ['image' => $path])){
            return back()->with('error','Opps!, Erro ao atualizar a foto usuário.');
        }

        return redirect()->route('admin.profile.index')->with('success','Pronto!, Foto atualizada com sucesso.');*/
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
