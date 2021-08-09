<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    
    private $types = [
        1 => [
            'name' => 'Email',
            'input' => 'email_text',
            'required' => 'Поле "Сообщение по Email" необходимо заполнить',
            'active' => true
        ],
        2 => [
            'name' => 'Браузер',
            'input' => 'text',
            'required' => 'Поле "Сообщение в браузер" необходимо заполнить',
            'active' => true
        ],
        3 => [
            'name' => 'Смс',
            'input' => 'text',
            'required' => 'Поле "Сообщение по смс" необходимо заполнить',
            'active' => false
        ]
    ];
    
    protected $guarded = ['_token'];
    
    public function getTypes():array {
        return $this->types;
    }
}
