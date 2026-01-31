<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_code',
        'total_price',
        'status',

        // detail penerima
        'receiver_name',
        'receiver_email',
        'receiver_phone',
        'shipping_address',
        'delivery_method',
        'shipping_note',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // ===== helper untuk badge status =====
    public function statusLabel(): string
    {
        return match ($this->status) {
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'diproses'            => 'Diproses',
            'dikirim'             => 'Dikirim',
            'terkirim'            => 'Terkirim',
            'ditolak'             => 'Ditolak',
            default               => ucfirst(str_replace('_', ' ', (string) $this->status)),
        };
    }

    public function statusClass(): string
    {
        return match ($this->status) {
            'menunggu_verifikasi' => 'status-wait',
            'diproses'            => 'status-process',
            'dikirim'             => 'status-ship',
            'terkirim'            => 'status-done',
            'ditolak'             => 'status-reject',
            default               => 'status-default',
        };
    }
}
