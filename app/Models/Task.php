<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Table('tasks')]
#[Fillable(['title', 'is_completed'])]
class Task extends Model {}

