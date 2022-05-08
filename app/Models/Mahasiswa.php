<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mahasiswa extends Authenticatable
{
  use Notifiable;

  protected $table = 'mahasiswa';

  protected $guard = 'mahasiswa';

  public $timestamps = false;

  protected $fillable = [
    'nama', 'email', 'password', 'nim', 'fakultas', 'prodi'
  ];

  protected $hidden = [ 'password' ];
}
