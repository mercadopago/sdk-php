# CHANGELOG_ORDER_RESPONSE.md

## Atualização da Classe Order

### Antes
```php
class Order extends MPResource
{
    public ?string $id;
    public ?string $type;
    public ?string $external_reference;
    public ?string $country_code;
    public ?string $status;
    public ?string $status_detail;
    public ?string $capture_mode;
    public ?string $user_id;
    public ?string $client_token;
    public ?string $total_amount;
    public ?string $total_paid_amount;
    public ?string $processing_mode;
    public ?string $description;
    public ?string $marketplace;
    public ?string $marketplace_fee;
    public ?string $created_date;
    public ?string $last_updated_date;
    public ?string $checkout_available_at;
    public ?string $expiration_time;
    public array|object|null $integration_data;
    public array|object|null $payer;
    public array|object|null $transactions;
    public ?array $items;
    public array|object|null $config;
    public ?array $additional_info;
}
```

### Depois
```php
class Order extends MPResource
{
    public ?string $id;
    public ?string $type;
    public ?string $external_reference;
    public ?string $country_code;
    public ?string $status;
    public ?string $status_detail;
    public ?string $capture_mode;
    public ?string $user_id;
    /** @deprecated Campo obsoleto: não faz parte do contrato JSON atual. */
    public ?string $client_token;
    public ?string $total_amount;
    public ?string $total_paid_amount;
    public ?string $processing_mode;
    public ?string $description;
    public ?string $marketplace;
    public ?string $marketplace_fee;
    public ?string $created_date;
    public ?string $last_updated_date;
    /** @deprecated Campo obsoleto: não faz parte do contrato JSON atual. */
    public ?string $checkout_available_at;
    /** @deprecated Campo obsoleto: não faz parte do contrato JSON atual. */
    public ?string $expiration_time;
    public array|object|null $integration_data;
    /** @deprecated Campo obsoleto: não faz parte do contrato JSON atual. */
    public array|object|null $payer;
    public array|object|null $transactions;
    public ?array $items;
    /** @deprecated Campo obsoleto: não faz parte do contrato JSON atual. */
    public array|object|null $config;
    /** @deprecated Campo obsoleto: não faz parte do contrato JSON atual. */
    public ?array $additional_info;
}
```

### JSON de Exemplo
```json
{
  "id": "ORD01HRYFWNYRE1MR1E60MW3X0T2P",
  "type": "online",
  "processing_mode": "automatic",
  "external_reference": "ext_ref_1234",
  "description": "some description",
  "marketplace": "NONE",
  "marketplace_fee": "10.00",
  "total_amount": "1000.00",
  "total_paid_amount": "1000.00",
  "country_code": "BRA",
  "user_id": "1245621468",
  "status": "processed",
  "status_detail": "accredited",
  "capture_mode": "automatic_async",
  "created_date": "2024-11-21T14:19:14.727Z",
  "last_updated_date": "2024-11-21T14:19:18.489Z",
  "integration_data": {
    "application_id": "130106526144588"
  },
  "transactions": {
    "payments": [
      {
        "id": "PAY01JD7HETD7WX4W31VA60R1KC8E",
        "amount": "1000.00",
        "paid_amount": "1000.00",
        "expiration_time": "P1D",
        "date_of_expiration": "2024-01-01T00:00:00.000-03:00",
        "reference_id": "22dvqmsf4yc",
        "status": "processed",
        "status_detail": "accredited",
        "payment_method": {
          "id": "master",
          "type": "credit_card",
          "token": "677859ef5f18ea7e3a87c41d02c3fbe3",
          "statement_descriptor": "LOJA X",
          "installments": 1
        }
      }
    ]
  },
  "items":[
    {
    "external_code": "item_external_code",
    "category_id": "category_id",
    "title": "Some item title",
    "description": "Some item description",
    "unit_price": "1000.00",
    "type": "item type",
    "picture_url": "https://mysite.com/img/item.jpg",
    "quantity": 1
  }
  ]
}
``` 