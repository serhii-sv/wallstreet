<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Mail;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class NotificationMail
 *
 * @package App\Mail
 */
class NotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    /** @var int $tries */
    public $tries = 1;
    
    /** @var User $user */
    protected $user;
    
    /** @var array $data */
    protected $data;
    
    protected $email_text;
    public    $subject;
    
    // User $user, string $code, array $data=null
    public function __construct(User $user, $subject, $email_text) {
        $this->email_text = $email_text;
        $this->user = $user;
        $this->subject = $subject;
        //        $this->data     = $data;
        //        $this->code     = $code;
    }
    
    
    public function build() {
        
        return $this->from('fnxrus@gmail.com')->subject($this->subject)->markdown('mail.markdown', [
                'user' => $this->user,
                'email_text' => $this->email_text,
            ]);
    }
}
