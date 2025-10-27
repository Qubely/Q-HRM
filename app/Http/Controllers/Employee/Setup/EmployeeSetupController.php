<?php

namespace App\Http\Controllers\Employee\Setup;

use App\Http\Controllers\Controller;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Webpatser\Uuid\Uuid;
use App\Http\Requests\Employee\Setup\ValidateEmployeeProfileSetup;
use App\Http\Requests\Employee\Setup\ValidateEmployeeLogin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class EmployeeSetupController extends Controller
{
    use BaseTrait;
    public function __construct()
    {
       $this->middleware(['auth:employee','HasEmployeeAuth']);
       $this->sizes =  [
            ['width'=>300, 'height'=> 300,'com'=> 90],
            ['width'=>80, 'height'=> 80,'com'=> 100],
       ];
       $this->lang = 'employee.profile.setup';
    }

    /**
     * View Employee profile setup
     *
     * @param Request $request
     * @return View
    */
    public function index(Request $request) :  RedirectResponse | View
    {
        $user = Auth::user();
        if($user->setup_done == "yes") {
            return redirect()->route('employee.dashboard.index');
        }
        $data['item'] = $user;
        $data['lang'] = $this->lang;
        return  view('employee.pages.setup.index')->with("data",$data);
    }

     /**
     * Employee Profile Update
     *
     * @param  Request $request
     * @return JsonResponse
    */
    public function update(Request $request) : JsonResponse
    {
        $user = Employee::find($request?->auth?->id);
        if (empty($user)) {
            return $this->response([ 'type' => "noUpdate", "title" => pxLang($this->lang,'mgs.no_user')]);
        }
        $validator = Validator::make($request->all(), (new ValidateEmployeeProfileSetup())->rules($request, $user));
        if ($validator->fails()) {
            return $this->response(['type' => 'validation', 'errors' => $validator->errors()]);
        }
        try {
            $user->name = $request->name;
            $user->mobile_number = $request->mobile_number;
            $user->email = $request->email;
            $user->password = Hash::make($request->confim_password);
            $user->setup_done = "yes";
            $path = imagePaths()['dyn_image'];
            $image = $request->file('image');
            if (!empty($image)) {
                $this->deleteImageVersions([
                    'path' => $path,
                    'image_link' => $user->image,
                    'extension' => $user->extension,
                    'sizes' =>  $this->sizes
                ]);
                $image_link = (string) Uuid::generate(4);
                $extension = $image->getClientOriginalExtension();
                $this->imageVersioning([
                    'image' => $image, 'path' => $path, 'image_link' => $image_link, 'extension' => $extension,
                    'appendSize' => true,
                    'onlyAppend' => $this->sizes
                ]);
                $user->image = $image_link;
                $user->extension = $extension;
            }
            $user->save();
            $data['extraData'] = [
                "redirect" => 'employee/dashboard',
                "inflate" =>  pxLang($this->lang,'mgs.update_success')
            ];
            return $this->response(['type' => 'success', "data" => $data]);
        } catch (\Exception $e) {
            $this->saveError($this->getSystemError(['name' => 'update_Employee_profile_error']), $e);
            return $this->response(["type" => "wrong", "lang" => "server_wrong"]);
        }
    }
}
