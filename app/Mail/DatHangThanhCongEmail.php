<?php
namespace App\Mail;
use App\Models\DonHang;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
class DatHangThanhCongEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $donhang;

    public function __construct(DonHang $dh)
    {
        $this->donhang = $dh;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Đặt hàng thành công tại ' . config('app.name', 'Laravel'),
        );
    }
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.dathangthanhcong',
            with: [
                'donhang' => $this->donhang,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
