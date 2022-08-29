<?php

namespace App;

use App\Notifications\NewUserResetPasswordNotification;
use App\Notifications\UserResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Role;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'email_verified_at', 'password', 'role_id', 'active', 'remember_token', 'first_name', 'last_name', 'avatar', 'user_id', 'isDeleted', 'is_one_time'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getRoleAttribute($value)
    {
        return strtoupper($value);
    }

    public function role_name()
    {
        return User::userRole($this->role_id);
    }

    public static function totalUser()
    {
        $total = User::where('active','=',1)->count();

        return $total;
    }

    public static function activeTotalUser()
    {
        $total = User::where('active','=',1)->count();

        return $total;
    }

    public static function inactiveTotalUser()
    {
        $total = User::where('active','=',0)->count();

        return $total;
    }

    public static function userEmail($id)
    {
        $data = User::where('id',$id)->first();

        return $data->email;
    }

    public static function userRole($id)
    {
        $data = Role::where('id',$id)->first();

        if (!$data) {
            return '';
        }

        return $data->name;
    }

    public function send_reset_password_email()
    {
        $token = app('auth.password.broker')->createToken($this);

        $this->notify(new UserResetPasswordNotification($token));
    }

    public function send_reset_temporary_password_email()
    {
        $token = app('auth.password.broker')->createToken($this);

        $this->notify(new NewUserResetPasswordNotification($token));
    }

    public function has_access_to_pages_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[0]);
    }

    public function has_access_to_albums_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[1]);
    }

    public function has_access_to_file_manager_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[2]);
    }

    public function has_access_to_menu_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[3]);
    }

    public function has_access_to_news_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[4]);
    }

    public function has_access_to_news_categories_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[5]);
    }

    public function has_access_to_website_settings_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[6]);
    }

    public function has_access_to_audit_logs_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[7]);
    }

    public function has_access_to_user_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[8]);
    }

    public function has_access_to_product_category_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[9]);
    }

    public function has_access_to_product_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[10]);
    }

    public function has_access_to_subscriber_group_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[11]);
    }

    public function has_access_to_subscriber_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[12]);
    }

    public function has_access_to_campaign_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[13]);
    }

    public function has_access_to_mailing_list_sent_items_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[14]);
    }

    public function has_access_to_download_manager_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[15]);
    }

    public function has_access_to_download_manager_group_module()
    {
        return $this->has_access_to_module(array_keys(Permission::modules())[16]);
    }

    private function has_access_to_module($module)
    {
        if ($this->is_an_admin() == 1) {
            return true;
        }

        $routes = $this->get_module_routes($module);

        foreach($routes as $route) {
            if ($this->is_route_exist_to_user_permission($route)) {
                return true;
                break;
            }
        }

        return false;
    }

    private function get_module_routes($module)
    {
        return Permission::where('module', $module)->pluck('name');
    }

    private function is_route_exist_to_user_permission($route)
    {
        return \App\ViewPermissions::check_permission($this->role_id, $route) == 1;
    }

    public function has_access_to_route($route)
    {
        if ($this->is_an_admin()) {
            return true;
        }

        $userPermissionRoutes = $this->get_assigned_routes();

        if (in_array($route, $userPermissionRoutes)) {
            return true;
        }

        return false;
    }

    public function get_assigned_routes()
    {
        $permission = $this->assign_role->permissions;

        if ($permission) {
            return $permission->pluck('routes')->flatten()->all();
        }

        return [];
    }

    public function get_image_url_storage_path()
    {
        $delimiter = 'storage/';
        if (strpos($this->avatar, $delimiter) !== false) {
            $paths = explode($delimiter, $this->avatar);
            return $paths[1];
        }

        return '';
    }

    public function get_image_file_name()
    {
        $path = explode('/', $this->avatar);
        $nameIndex = count($path) - 1;
        if ($nameIndex < 0)
            return '';

        return $path[$nameIndex];
    }

    public function is_an_admin()
    {
        return $this->role_id == 1;
    }

    public function is_not_an_admin()
    {
        return $this->role_id != 1;
    }

    public function assign_role()
    {
        return $this->belongsTo(Role::class,'role_id', 'id');
    }


    public function user_role_redirect () 
    {

        if($this->role_id == env('SUPPLIER_ID'))
            return "sms.auth.profile.edit";

        if($this->role_id == env('APPROVER_ID'))
            return "approver.dashboard";

        if($this->role_id == env('EVALUATOR_ID'))
            return "evaluator.dashboard";

        return "home";
        
    }
    



    // Relationships

    public function supplier_details () 
    {
        return $this->hasOne('App\SupplierModels\SupplierDetails', 'supplier_id');
    }

    public function supplier_officers () 
    {
        return $this->hasMany('App\SupplierModels\SupplierOfficers', 'supplier_id');
    }

    public function supplier_banks ()    
    {
        return $this->hasMany('App\SupplierModels\SupplierBankDetails', 'supplier_id');
    }

    public function supplier_credits () 
    {
        return $this->hasMany('App\SupplierModels\SupplierCredits', 'supplier_id');
    }
    
    public function supplier_services () 
    {
        return $this->hasMany('App\SupplierModels\SupplierServices', 'supplier_id');
    }
    
    public function supplier_requirements()
    {
        return $this->hasMany('App\SupplierModels\SupplierRequirements', 'supplier_id');
    }

    public function supplier_certifications () 
    {
        return $this->hasMany('App\SupplierModels\SupplierCertifications', 'supplier_id');
    }

    public function supplier_customers () 
    {
        return $this->hasMany('App\SupplierModels\SupplierCustomers', 'supplier_id');
    }
    
    public function supplier_contacts () 
    {
        return $this->hasMany('App\SupplierModels\SupplierContactDetails', 'supplier_id');
    }
    
    public function supplier_financial_status()
    {
        return $this->hasMany('App\SupplierModels\SupplierFinancialStatus', 'supplier_id');
    }

    public function supplier_payment_terms()
    {
        return $this->hasMany('App\SupplierModels\SupplierPaymentTerms', 'supplier_id');
    }
    

    public function approver_sequence()
    {
        return $this->hasOne('App\SupplierModels\ApproverTemplates', 'approver_id');
    }


    public function supplier_business_lines() {
        return $this->hasMany('App\SupplierModels\SupplierBusinessLines', 'supplier_id');
    }


    public function approver_settings () 
    {
        return $this->hasOne('App\SupplierModels\ApproversSetting', 'approver_id');
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
