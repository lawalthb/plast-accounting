<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
class Users extends Authenticatable implements MustVerifyEmail , Auditable
{
	use Notifiable;
	use \OwenIt\Auditing\Auditable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'users';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	protected $fillable = ['email','password','phone','photo','username','firstname','lastname','role_id','user_type','is_active','company_id','user_role_id'];
	public $timestamps = true;
	const CREATED_AT = 'date_created'; 
	const UPDATED_AT = 'date_updated'; 
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				users.firstname LIKE ?  OR 
				users.lastname LIKE ?  OR 
				users.email LIKE ?  OR 
				users.username LIKE ?  OR 
				users.phone LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"users.id AS id",
			"users.firstname AS firstname",
			"users.lastname AS lastname",
			"users.email AS email",
			"users.photo AS photo",
			"users.date_join AS date_join",
			"users.username AS username",
			"users.user_role_id AS user_role_id",
			"roles.role_name AS roles_role_name",
			"users.is_active AS is_active",
			"users.date_created AS date_created",
			"users.date_updated AS date_updated" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"users.id AS id",
			"users.firstname AS firstname",
			"users.lastname AS lastname",
			"users.email AS email",
			"users.photo AS photo",
			"users.date_join AS date_join",
			"users.username AS username",
			"users.user_role_id AS user_role_id",
			"roles.role_name AS roles_role_name",
			"users.is_active AS is_active",
			"users.date_created AS date_created",
			"users.date_updated AS date_updated" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id",
			"firstname",
			"lastname",
			"email",
			"role_id",
			"phone",
			"user_type",
			"date_join",
			"is_active",
			"company_id",
			"username",
			"email_verified_at",
			"user_role_id",
			"date_created",
			"date_updated" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id",
			"firstname",
			"lastname",
			"email",
			"role_id",
			"phone",
			"user_type",
			"date_join",
			"is_active",
			"company_id",
			"username",
			"email_verified_at",
			"user_role_id",
			"date_created",
			"date_updated" 
		];
	}
	

	/**
     * return accountedit page fields of the model.
     * 
     * @return array
     */
	public static function accounteditFields(){
		return [ 
			"id",
			"firstname",
			"lastname",
			"role_id",
			"phone",
			"photo",
			"user_type",
			"is_active",
			"company_id",
			"username",
			"user_role_id" 
		];
	}
	

	/**
     * return accountview page fields of the model.
     * 
     * @return array
     */
	public static function accountviewFields(){
		return [ 
			"id",
			"firstname",
			"lastname",
			"email",
			"role_id",
			"phone",
			"user_type",
			"date_join",
			"is_active",
			"company_id",
			"username",
			"email_verified_at",
			"user_role_id",
			"date_created",
			"date_updated" 
		];
	}
	

	/**
     * return exportAccountview page fields of the model.
     * 
     * @return array
     */
	public static function exportAccountviewFields(){
		return [ 
			"id",
			"firstname",
			"lastname",
			"email",
			"role_id",
			"phone",
			"user_type",
			"date_join",
			"is_active",
			"company_id",
			"username",
			"email_verified_at",
			"user_role_id",
			"date_created",
			"date_updated" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"firstname",
			"lastname",
			"role_id",
			"phone",
			"photo",
			"user_type",
			"is_active",
			"company_id",
			"username",
			"user_role_id",
			"id" 
		];
	}
	

	/**
     * return adminlist page fields of the model.
     * 
     * @return array
     */
	public static function adminlistFields(){
		return [ 
			"id",
			"firstname",
			"lastname",
			"email",
			"role_id",
			"phone",
			"photo",
			"user_type",
			"date_join",
			"is_active",
			"company_id",
			"username",
			"email_verified_at",
			"user_role_id",
			"date_created",
			"date_updated" 
		];
	}
	

	/**
     * return exportAdminlist page fields of the model.
     * 
     * @return array
     */
	public static function exportAdminlistFields(){
		return [ 
			"id",
			"firstname",
			"lastname",
			"email",
			"role_id",
			"phone",
			"photo",
			"user_type",
			"date_join",
			"is_active",
			"company_id",
			"username",
			"email_verified_at",
			"user_role_id",
			"date_created",
			"date_updated" 
		];
	}
	

	/**
     * Audit log events
     * 
     * @var array
     */
	protected $auditEvents = [
		'created', 'updated', 'deleted'
	];
	

	/**
     * Get current user name
     * @return string
     */
	public function UserName(){
		return $this->username;
	}
	

	/**
     * Get current user id
     * @return string
     */
	public function UserId(){
		return $this->id;
	}
	public function UserEmail(){
		return $this->email;
	}
	public function UserPhoto(){
		return $this->photo;
	}
	public function UserRole(){
		return $this->user_role_id;
	}
	

	/**
     * Send Password reset link to user email 
	 * @param string $token
     * @return string
     */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new \App\Notifications\ResetPassword($token));
	}
	

	/**
     * Send user account verification link to user email
     * @return string
     */
	public function sendEmailVerificationNotification()
	{
		$this->notify(new \App\Notifications\VerifyEmail);
	}
	
	private $roleNames = [];
	private $userPages = [];
	
	/**
	* Get the permissions of the user.
	*/
	public function permissions(){
		return $this->hasMany(Permissions::class, 'role_id', 'user_role_id');
	}
	
	/**
	* Get the roles of the user.
	*/
	public function roles(){
		return $this->hasMany(Roles::class, 'role_id', 'user_role_id');
	}
	
	/**
	* set user role
	*/
	public function assignRole($roleName){
		$roleId = Roles::select('role_id')->where('role_name', $roleName)->value('role_id');
		$this->user_role_id = $roleId;
		$this->save();
	}
	
	/**
     * return list of pages user can access
     * @return array
     */
	public function getUserPages(){
		if(empty($this->userPages)){ // ensure we make db query once
			$this->userPages = $this->permissions()->pluck('permission')->toArray();
		}
		return $this->userPages;
	}
	
	/**
     * return user role names
     * @return array
     */
	public function getRoleNames(){
		if(empty($this->roleNames)){// ensure we make db query once
			$this->roleNames = $this->roles()->pluck('role_name')->toArray();
		}
		return $this->roleNames;
	}
	
	/**
     * check if user has a role
     * @return bool
     */
	public function hasRole($arrRoles){
		if(!is_array($arrRoles)){
			$arrRoles = [$arrRoles];
		}
		$userRoles = $this->getRoleNames();
		if(array_intersect(array_map('strtolower', $userRoles), array_map('strtolower', $arrRoles))){
			return true;
		}
		return false;
	}
	
	/**
     * check if user is the owner of the record
     * @return bool
     */
	public function isOwner($recId){
		return $this->UserId() == $recId;
	}
	
	/**
     * check if user can access page
     * @return bool
     */
	public function canAccess($path){
		$userPages = $this->getUserPages();
		$arrPaths = explode("/", strtolower($path));
		$page = $arrPaths[0] ?? "home";
		$action = $arrPaths[1] ?? "list";
		if($action == "index" || $action == "masterdetail"){
			$action = "list";
		}
		return in_array("$page/$action", $userPages);
	}
	
	/**
     * check if user is the owner of the record or has role that can edit or delete it
     * @return bool
     */
	public function canManage($path, $recId){
		return false;
	}
}
