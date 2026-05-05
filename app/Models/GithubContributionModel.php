<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GithubContribution extends Model
{
    public $total;
    public $weeks;

    public function __construct($total, $weeks)
    {
        $this->total = $total;
        $this->weeks = $weeks;
    }
}