<?php

namespace Domain\Payment\Payment;

use Domain\Payment\Exceptions\PaymentProviderException;
use Domain\Payment\Payment\Contract\PaymentGatewayContract;
use Domain\Payment\PaymentData;
use Illuminate\Http\JsonResponse;
use Support\ValueObjects\Price;
use YooKassa\Client;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;
use YooKassa\Model\NotificationEventType;
use YooKassa\Model\Payment;
use YooKassa\Model\PaymentInterface;
use YooKassa\Model\PaymentStatus;
use YooKassa\Request\Payments\PaymentResponse;

final class YooKassa implements PaymentGatewayContract
{
    protected Client $client;

    protected PaymentData $paymentData;

    protected string $errorMessage;

    public function __construct(array $config)
    {
        $this->client = new Client();

        $this->configure($config);
    }

    public function paymentId(): string
    {
        return $this->paymentData->getId();
    }

    public function configure(array $config): void
    {
        $this->client->setAuth(...$config);
    }

    public function data(PaymentData $data): PaymentGatewayContract
    {
        $this->paymentData = $data;

        return $this;
    }

    public function request(): mixed
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    /**
     * @throws PaymentProviderException
     */
    public function response(): JsonResponse
    {
        try {
            $response = $this->client
                ->capturePayment(
                    $this->payload(),
                    $this->paymentObject()->getId(),
                    $this->idempotenceKey()
                );

        } catch (\Throwable $exception) {
            $this->errorMessage = $exception->getMessage();

            throw new PaymentProviderException($exception->getMessage());
        }

        return response()->json($response);
    }

    /**
     * @throws PaymentProviderException
     */
    public function url(): string
    {
        try {
            $response = $this->client->capturePayment(
                $this->payload(),
                $this->idempotenceKey()
            );

            return $response
                ->getConfirmation()
                ->getConfirmationUrl();

        } catch (\Exception $exception) {
            throw new PaymentProviderException($exception->getMessage());
        }
    }

    /**
     * @throws PaymentProviderException
     */
    public function validate(): bool
    {
        $meta = $this->paymentObject()->getMetadata()->toArray();

        $this->data(new PaymentData(
            $this->paymentObject()->getId(),
            $this->paymentObject()->getDescription(),
            '',
            Price::make(
                $this->paymentObject()->getAmount()->getIntegerValue(),
                $this->paymentObject()->getAmount()->getCurrency(),
            ),
            collect($meta)
        ));

        return $this->paymentObject()->getStatus() === PaymentStatus::WAITING_FOR_CAPTURE;
    }

    /**
     * @throws PaymentProviderException
     */
    public function paid(): bool
    {
        return $this->paymentObject()->getPaid();
    }

    /**
     * @throws PaymentProviderException
     */
    public function errorMessage(): string
    {
        return $this->errorMessage;
    }

    private function payload(): array
    {
        return [
            'amount' => [
                'value' => $this->paymentData->getAmount()->value(),
                'currency' => $this->paymentData->getAmount()->currency(),
            ],
            'configuration' => [
                'type' => 'redirect',
                'return_url' => $this->paymentData->getReturnUrl(),
            ],
            'description' => $this->paymentData->getDescription(),
            'receipt' => [
                'items' => [
                    [
                        'quantity' => 1,
                        'amount' => [
                            'value' => $this->paymentData->getAmount()->value(),
                            'currency' => $this->paymentData->getAmount()->currency(),
                        ],
                        'vat_code' => 1,
                        'description' => $this->paymentData->getDescription(),
                        'payment_subject' => 'intellectual_activity',
                        'payment_mode' => 'full_payment',
                    ],
                ],
                'tax_system_code' => 1,
                'email' => $this->paymentData->getMeta()->get('email'),
            ],
            'metadata' => $this->paymentData->getMeta()->toArray(),
        ];
    }

    /**
     * @throws PaymentProviderException
     */
    private function paymentObject(): PaymentResponse|Payment|PaymentInterface
    {
        $request = $this->request();

        try {
            $notification = ($request['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
                ? new NotificationSucceeded($request)
                : new NotificationWaitingForCapture($request);

        } catch (\Exception $exception) {
            $this->errorMessage = $exception->getMessage();

            throw new PaymentProviderException($exception->getMessage());
        }

        return $notification->getObject();
    }

    private function idempotenceKey(): string
    {
        return uniqid('', true);
    }
}
