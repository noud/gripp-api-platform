<?php

namespace App\Gripp\Enum\Entity\Webhook;

use App\Gripp\Enum\AbstractEnum;

class TriggerEnum extends AbstractEnum
{
    const NEW_COMPANY_CREATED = 'NEW_COMPANY_CREATED';
    const NEW_CONTRACT_CREATED = 'NEW_CONTRACT_CREATED';
    const NEW_EMPLOYEE_CREATED = 'NEW_EMPLOYEE_CREATED';
    const NEW_INVOICE_CREATED = 'NEW_INVOICE_CREATED';
    const NEW_OFFER_CREATED = 'NEW_OFFER_CREATED';
    const NEW_PROJECT_CREATED = 'NEW_PROJECT_CREATED';
    const NEW_TASK_CREATED = 'NEW_TASK_CREATED';
    const OFFER_ACCEPTED = 'OFFER_ACCEPTED';
    const OFFER_DECLINED = 'OFFER_DECLINED';
    const NEW_HOUR_CREATED = 'NEW_HOUR_CREATED';
    const INVOICE_SENT = 'INVOICE_SENT';
    const NEW_PAYMENT = 'NEW_PAYMENT';
    const NEW_PURCHASEPAYMENT = 'NEW_PURCHASEPAYMENT';
    const NEW_CONTACT_CREATED = 'NEW_CONTACT_CREATED';
    const NEW_TIMELINEENTRY = 'NEW_TIMELINEENTRY';
    const TASK_DONE = 'TASK_DONE';
    const NEW_PURCHASEINVOICE_CREATED = 'NEW_PURCHASEINVOICE_CREATED';
    const NEW_PURCHASEORDER_CREATED = 'NEW_PURCHASEORDER_CREATED';

    /**
     * @return string[]
     */
    public static function getLabels(): array
    {
        return [
            self::NEW_COMPANY_CREATED => 'enum.webhook.trigger.company.created',
            self::NEW_CONTRACT_CREATED => 'enum.webhook.trigger.contract.created',
            self::NEW_EMPLOYEE_CREATED => 'enum.webhook.trigger.employee.created',
            self::NEW_INVOICE_CREATED => 'enum.webhook.trigger.invoice.created',
            self::NEW_OFFER_CREATED => 'enum.webhook.trigger.offer.created',
            self::NEW_PROJECT_CREATED => 'enum.webhook.trigger.project.created',
            self::NEW_TASK_CREATED => 'enum.webhook.trigger.task.created',
            self::OFFER_ACCEPTED => 'enum.webhook.trigger.offer.accepted',
            self::OFFER_DECLINED => 'enum.webhook.trigger.offer.declined',
            self::NEW_HOUR_CREATED => 'enum.webhook.trigger.hour.created',
            self::INVOICE_SENT => 'enum.webhook.trigger.invoice.sent',
            self::NEW_PAYMENT => 'enum.webhook.trigger.payment',
            self::NEW_PURCHASEPAYMENT => 'enum.webhook.trigger.purchasepayment',
            self::NEW_CONTACT_CREATED => 'enum.webhook.trigger.contact.created',
            self::NEW_TIMELINEENTRY => 'enum.webhook.trigger.timelineentry',
            self::TASK_DONE => 'enum.webhook.trigger.task.done',
            self::NEW_PURCHASEINVOICE_CREATED => 'enum.webhook.trigger.purchaseinvoice.created',
            self::NEW_PURCHASEORDER_CREATED => 'enum.webhook.trigger.purchaseorder.created',
        ];
    }

    public static function getChoices(): array
    {
        return array_flip(self::getLabels());
    }
}
