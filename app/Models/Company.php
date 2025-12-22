<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'websites',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'industry',
        'notes',
        'user_id',
    ];

    protected $casts = [
      
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',

    ];

    public function assignedTo(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeAssignedTo($query, $userId){
            return $query->where('user_id', $userId);
    }

    public function scopeSearch($query, $searchTerm){
       
        return $query->where(function ($q) use ($searchTerm){
            $q->where(['name', 'like', "%{searchTerm}%"])
            ->orWhere(['email', 'like', "%{searchTerm}%"])
            ->orWhere(['industry', 'like', "%{searchTerm}%"]);
        });
    }

    public function getFullAddressAttribute(){
        $parts = array_filter([
            $this->address,
            $this->city,
            $this->state,
            $this->postal_code,
            $this->country,
        ]);

        return implode(" ", $parts);
    }
}
