<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EmailAttachment;

class Email extends Model
{
    protected $table = 'emails';

    /**
     * Get the attachments for the email.
     */
    public function attachments()
    {
        return $this->hasMany(EmailAttachment::class, 'uid', 'uid');
    }
}
