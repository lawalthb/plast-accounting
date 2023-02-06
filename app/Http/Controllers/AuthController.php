<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Http\Requests\UsersRegisterRequest;
use App\Models\permissions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
class AuthController extends Controller{
	

	/**
     * Authenticate and login user
     * @return \Illuminate\Http\Response
     */
	function login(Request $request){
		$username = $request->username;
		$password = $request->password;
		if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
			Auth::attempt(['email' => $username, 'password' => $password]); //login with email 
		} 
		else {
			Auth::attempt(['username' => $username, 'password' => $password]); //login with username
		}
        if (!Auth::check()) {
            return redirect("index/login")->withErrors(__('usernameOrPasswordNotCorrect'));
        }
		$user = auth()->user();
		return $this->redirectIntended("/home", __('loginCompleted'));
	}
	

	/**
     * Logout user from session
     * @return \Illuminate\Http\Response
     */
	function logout(Request $request){
		Auth::logout();
		return redirect('/');
	}
	

	/**
     * Display user registration form
     * @return \Illuminate\View\View
     */
	function register(){
		return view("pages.index.register");
	}
	

	/**
     * Save new user record
     * @return \Illuminate\Http\Response
     */
	function register_store(UsersRegisterRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("photo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['photo'], "photo");
			$modeldata['photo'] = $fileInfo['filepath'];
		}
		$modeldata['password'] = bcrypt($modeldata['password']);
		
		//save Users record
		$user = $record = Users::create($modeldata);
		$user->assignRole("User"); //set default role for user
		$rec_id = $record->id;
		$user->sendEmailVerificationNotification();
		return redirect()->route('verification.verify', ['id' => $user->id]);
	}
	

	/**
     * Logout user from session
     * @return \Illuminate\Http\Response
     */
	function accountcreated(Request $request){
		return view("pages.index.accountcreated");
	}
	

	/**
     * Logout user from session
     * @return \Illuminate\Http\Response
     */
	function accountblocked(Request $request){
		//commit blank;
		return view("pages.index.accountblocked");
	}
	

	/**
     * Logout user from session
     * @return \Illuminate\Http\Response
     */
	function accountpending(Request $request){
		return view("pages.index.accountpending");
	}
	

	/**
     * Verify user email
     * @return \Illuminate\Http\Response
     */
	public function verifyEmail(Request $request) {
		$user_id = $request->get("id");
		if (!$request->hasValidSignature()) {
			//lawal;
			return view('pages.verifyemail.message')->withErrors("Invalid/Expired url provided");
		}
		$user = Users::findOrFail($user_id);
		if (!$user->hasVerifiedEmail()) {
			$user->markEmailAsVerified();
		}
		return redirect()->route("verification.verified");
	}
	

	/**
     * Resend verify email message
     * @return \Illuminate\View\View
     */
	public function resendVerifyEmail(Request $request) {
		$user_id = $request->get("id");
		$user = Users::findOrFail($user_id);
		if ($user->hasVerifiedEmail()) {
			return view('pages.verifyemail.message')->withErrors("Email already verified.");
		}
		$user->sendEmailVerificationNotification();
		return view('pages.verifyemail.message')->with("message", __('emailVerificationResent'));
	}
	

	/**
     * Display email verified page
     * @return \Illuminate\View\View
     */
	public function emailVerified() {
		return view("pages.verifyemail.emailverified");
	}
	

	/**
     * Display verify email page
     * @return \Illuminate\View\View
     */
	public function showVerifyEmail() {
		return view("pages.verifyemail.message")->with('id', auth()->user()->id);
	}
	

	/**
     * Display forgot password page
     * @return \Illuminate\View\View
     */
	public function showForgotPassword() {
		return view("pages.passwordreset.forgotpassword");
	}
	

	/**
     * Display reset password form
     * @return \Illuminate\View\View
     */
	public function showResetPassword() {
		return view("pages.passwordreset.resetpassword");
	}
	

	/**
     * Display page when password reset link is sent
     * @return \Illuminate\View\View
     */
	public function passwordResetLinkSent() {
		return view("pages.passwordreset.resetlinksent");
	}
	

	/**
     * Display page when password reset is completed
     * @return \Illuminate\View\View
     */
	public function passwordResetCompleted() {
		return view("pages.passwordreset.resetcompleted");
	}
	

	/**
     * send password reset link to user email
     * @return \Illuminate\Http\Response
     */
	public function sendPasswordResetLink(Request $request) {
		$validated = $this->validate($request, [
			'email' => "required|email",
		]);
		try{
			$response = Password::sendResetLink($validated, function (Message $message) {
				$message->subject($this->getEmailSubject());
			});
			return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->sendResetFailedResponse($request, $response);
		}
		catch (\Swift_TransportException $ex) {
			return $this->sendResetFailedResponse($request, $ex->getMessage());
		} 
		catch (Exception $ex) {
			return $this->sendResetFailedResponse($request, $ex->getMessage());
		}
	}
	

	/**
     * Reset user password
     * @return \Illuminate\Http\Response
     */
	public function resetPassword(Request $request) {
		$validated = $this->validate($request, [
			'email' => 'required|email',
			'token' => 'required|string',
			"password" => "required|same:confirm_password",
		]);
		$response = Password::reset($validated, function ($user, $password) {
			$user->password = bcrypt($password);
			$user->save();
		});
		return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($response)
            : $this->sendResetFailedResponse($request, $response);
	}
	

	/**
     * Get the response for a successful password reset link sent.
     *
     * @param  string  $response
     * @return \Illuminate\Http\Response
     */
    protected function sendResetLinkResponse($response)
    {
        return redirect()->route('password.resetlinksent')->with('status', trans($response));
    }
	

	/**
     * Get the response for a successful password reset.
     *
     * @param  string  $response
     * @return \Illuminate\Http\Response
     */
    protected function sendResetResponse($response)
    {
        return redirect()->route('password.resetcompleted')->with('status', trans($response));
    }
	

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }
}
