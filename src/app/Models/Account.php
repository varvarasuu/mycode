<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Str;

class Account extends Model implements Authenticatable {
    use HasApiTokens, HasFactory, AuthenticatableTrait;

    protected $fillable = [
        'email',
        'password',
        'phone_number',
        'is_active',
        'avatar',
        'employer_status_id',
        'applicant_status_id',
        'chat_token'
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifier() {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password; // Replace 'password' with the name of the column storing the account's password
    }

    public function getRememberToken()
    {
        return $this->remember_token; // Replace 'remember_token' with the name of the column storing the "remember me" token
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value; // Replace 'remember_token' with the name of the column storing the "remember me" token
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // Replace 'remember_token' with the name of the column storing the "remember me" token
    }

    public function blacklist() {
        return $this->hasOne(BlackList::class, 'account_id');
    }

    public function user_companies()
    {
        return $this->hasMany(Company::class, 'account_id');
    }

    public function testTasks()
    {
        return $this->hasMany(TestTask::class, 'account_id');
    }

    public function recommendationLetters()
    {
        return $this->hasMany(RecommendationLetter::class);
    }

    public function createToken(string $name, array $abilities = ['*'], int $company_id = null, int $section_id = null,  DateTimeInterface $expiresAt = null)
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(40)),
            'abilities' => $abilities,
            'expires_at' => $expiresAt,
        ]);
        $token->company_id = $company_id;
        $token->section_id = $section_id;
        $token->save();

        return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
    }

    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'account_id', 'id');
    }

    public function resumes()
    {
        return $this->hasMany(Resume::class, 'account_id', 'id');
    }
}
