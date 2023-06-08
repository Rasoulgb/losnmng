<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Instalment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileRequest;

class UserController extends Controller
{
    public function index()
    {
        if (request()->user()->cannot('index', User::class)) {
            abort(403);
        }
        // $users = User::all();
        return  view('user.index');
    }
    public function show(User $user)
    {

        $viewData["title"] = 'Profile';
        $viewData["subtitle"] = 'Profile';
        $viewData["avatar"] = $user->avatar;
        $viewData["name"] = $user->name;
        return  view('user.profile', compact('viewData', 'user'));
    }

    public function top10(User $user)
    {
        $payDetails=[];
        $viewData["title"] = 'Profile';
        $viewData["subtitle"] = 'Profile';
        $viewData["avatar"] = 'Profile';
        $viewData["name"] = $user->name;
        $viewData["avatar"] = $user->avatar;

        $loans = Loan::where('user_id', $user->id)->limit(10)->simplepaginate(10);
        $viewData["loans"] = $loans;
        foreach ($loans as $key => $loan) {
            $id = $loan->id;
            $user = $loan->user->name;
            // dd($user);
            $total =   Instalment::where('loan_id', $id)->count('amount');
            $totalPaid = Instalment::where('loan_id', $id)->Paid()->count('amount');
            $remind = $total - $totalPaid;
            $payDetails[$id] = ['total' => $total, 'totalPaid' => $totalPaid, 'remind' => $remind, 'user' => $user];
        }

        return  view('user.profile-top10', compact('viewData','payDetails'));
    }

    public function createAvatar(User $user)
    {
        $viewData["title"] = 'Profile';
        $viewData["subtitle"] = 'Upload Avatar';
        return view('user.avatar-form')->with(compact('viewData'));
    }

    public function storeAvatar(Request $request)
    {

        $validated = $request->validate([
            'avatar' => 'file|required|image|max:2048',
        ]);

        $user = auth()->user();
        $fileName = $user->id . '-' . uniqid() . '.jpg';
        $imageData = Image::make($request->file('avatar'))->fit(120)->encode('jpg');
        Storage::put('public/Avatars/' . $fileName, $imageData);
        $oldavatar = $user->avatar;
        $oldavatar_replaced = str_replace("/storage/", "public/", $oldavatar);
        $user->avatar = $fileName;
        $user->save();
        if ($oldavatar != "/fallback-avatar.jpg" and Storage::exists($oldavatar_replaced)) {
            Storage::delete($oldavatar_replaced);
        }
        return  back()->with('success', 'Congrats On the new Avatar');
    }

    public function editprofile(User $user)
    {
        request()->session()->flash('id', $user->id);
        return view('user.editprofile', compact('user'));
    }
    public function updateprofile(User $user, UpdateProfileRequest $request)
    {

        $user->firstname = $request['firstname'];
        $user->surename = $request['surename'];
        $user->MobileNumber = $request['MobileNumber'];
        $user->Address = $request['Address'];
        $user->Education = $request['Education'];
        $user->save();
        return  back()->with('success', 'Congrats On the new Avatar');
    }
}
