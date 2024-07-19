<?php

namespace Modules\Privilege\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ModelEventLogger;

class UserDelegation extends Model
{
    use ModelEventLogger;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_delegations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_user',
        'to_user',
        'start_date',
        'end_date',
        'remarks',
        'is_active',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the from user that owns the delegation.
     */
    public function fromUser(){
        return $this->belongsTo('Modules\Privilege\Models\User', 'from_user');
    }

    /**
     * Get the to user that owns the delegation.
     */
    public function toUser(){
        return $this->belongsTo('Modules\Privilege\Models\User', 'to_user');
    }
}

