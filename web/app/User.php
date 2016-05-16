<?php
/**
 * Created by IntelliJ IDEA.
 * User: ANHHP
 * Date: 4/6/2016
 * Time: 9:47 AM
 */

namespace App;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = array('username', 'email', 'banned', 'userable_id', 'userable_type');

    protected $guarded = array('id', 'password');

    protected $hidden = array('password', 'remember_token');

    public static $rules_login = array(
        'username' => 'required|alpha_num|between:3,32',
        'password' => 'required|alpha_num|between:6,64',
    );

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    public function isAdmin() {
        return ($this->getUserableType() == 'admin');
    }

    public function userable() {
        return $this->morphTo();
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get userable_id
     */
    public function getUserableId() {
        return $this->userable_id;
    }

    /**
     * Get userable_type
     */
    public function getUserableType() {
        return $this->userable_type;
    }
    public function getUser() {

        $array = array('username' => $this->username, 'id' => $this->id, 'password' => $this->password, 'email' => $this->email);
        return $array;
    }
}