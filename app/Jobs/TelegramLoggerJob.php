<?php

namespace App\Jobs;

use App\Services\Telegram\TelegramBotApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TelegramLoggerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected string $token,
        protected int $chatId,
        protected string $text
    )
    {
    }

    public function handle(): void
    {
        TelegramBotApi::sendMessage($this->token, $this->chatId, $this->text);
    }
}
