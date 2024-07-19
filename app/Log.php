<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'original_user_id',
        'model',
        'model_id',
        'action',
        'description',
        'before_details',
        'after_details',
        'ip_address'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    /*
     * Get user of the log
     */
    public function user()
    {
        return $this->belongsTo('Modules\Privilege\Models\User', 'user_id')
            ->withDefault();
    }

    /*
     * Get original user of the log
     */
    public function originalUser()
    {
        return $this->belongsTo('Modules\Privilege\Models\User', 'original_user_id');
    }

    public function getUserFullNameAndEmail()
    {
        return $this->user ? $this->user->full_name .' ('. $this->user->email_address .')' : '';
    }

    public function getOriginalUserFullNameAndEmail()
    {
        return $this->originalUser ? $this->originalUser->full_name .' ('. $this->originalUser->email_address .')' : '';
    }

    public function getCreatedAt()
    {
        return $this->created_at->format('M d, Y h:i A');
    }
    
    public function getOriginalUserFullName()
    {
    return $this->originalUser ? $this->originalUser->full_name : '';
    }
}
