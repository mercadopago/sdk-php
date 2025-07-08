# Changelog Order Request

## Alterações em 2024-03-20

### Classe Order/Payer.php

**Antes:**
```php
class Payer
{
    /** Customer ID. */
    public ?string $customer_id;
}
```

**Depois:**
```php
class Payer
{
    /** @deprecated Customer ID. */
    public ?string $customer_id;

    /** Entity type. */
    public ?string $entity_type;

    /** Email. */
    public ?string $email;

    /** First name. */
    public ?string $first_name;

    /** Last name. */
    public ?string $last_name;

    /** Identification. */
    public array|object|null $identification;

    /** Phone. */
    public array|object|null $phone;

    /** Address. */
    public array|object|null $address;
}
```

### Classe Order/Payment.php (Nova)
```php
class Payment
{
    /** Amount. */
    public ?string $amount;

    /** Expiration time. */
    public ?string $expiration_time;

    /** Payment method. */
    public array|object|null $payment_method;
}
```

### Classe Order/PaymentMethod.php (Nova)
```php
class PaymentMethod
{
    /** ID. */
    public ?string $id;

    /** Type. */
    public ?string $type;

    /** Token. */
    public ?string $token;

    /** Installments. */
    public ?int $installments;

    /** Statement descriptor. */
    public ?string $statement_descriptor;
}
```

## Observações Importantes
- As classes foram criadas seguindo o padrão do SDK para classes de dados/recursos comuns
- Não foi necessário estender `MPResource` nem usar o trait `Mapper` pois estas classes são apenas estruturas de dados
- O mapeamento entre JSON e objetos é gerenciado pela classe principal `Order` que já possui o Mapper configurado

## Mapeamento JSON para Classes

### Estrutura Principal (Order)
```
Order
├── type: string
├── total_amount: string
├── external_reference: string
├── capture_mode: string
├── processing_mode: string
├── description: string
├── marketplace: string
├── marketplace_fee: string
├── expiration_time: string
└── transactions
    └── payments[]
        └── Payment
            ├── amount: string
            ├── expiration_time: string
            └── payment_method
                └── PaymentMethod
                    ├── id: string
                    ├── type: string
                    ├── token: string
                    ├── installments: int
                    └── statement_descriptor: string
└── payer
    └── Payer
        ├── entity_type: string
        ├── email: string
        ├── first_name: string
        ├── last_name: string
        ├── identification
        │   ├── type: string
        │   └── number: string
        ├── phone
        │   ├── area_code: string
        │   └── number: string
        └── address
            ├── street_name: string
            ├── street_number: string
            ├── zip_code: string
            ├── neighborhood: string
            ├── city: string
            ├── state: string
            └── complement: string
└── items[]
    └── Item
        ├── title: string
        ├── unit_price: string
        ├── quantity: int
        ├── description: string
        ├── external_code: string
        ├── category_id: string
        ├── type: string
        └── picture_url: string
```

### Exemplo de Mapeamento JSON para Classe

```json
{
  "payer": {                      // -> class Payer
    "entity_type": "individual",  //    -> public ?string $entity_type
    "email": "test@test.com",    //    -> public ?string $email
    "identification": {           //    -> public array|object|null $identification
      "type": "CPF",             //       -> class Identification -> public ?string $type
      "number": "123456789"      //       -> class Identification -> public ?string $number
    }
  },
  "transactions": {               // -> class Transactions
    "payments": [{               //    -> public ?array $payments
      "amount": "100.00",       //       -> class Payment -> public ?string $amount
      "payment_method": {       //       -> class Payment -> public array|object|null $payment_method
        "id": "master",        //          -> class PaymentMethod -> public ?string $id
        "type": "credit_card" //          -> class PaymentMethod -> public ?string $type
      }
    }]
  }
}
```

## JSON de Exemplo
```json
{
  "type": "online",
  "total_amount": "1000.00",
  "external_reference": "ext_ref_1234",
  "capture_mode": "automatic_async",
  "transactions": {
    "payments": [
      {
        "amount": "1000.00",
        "expiration_time": "P1D",
        "payment_method": {
          "id": "master",
          "type": "credit_card",
          "token": "677859ef5f18ea7e3a87c41d02c3fbe3",
          "installments": 1,
          "statement_descriptor": "LOJA X"
        }
      }
    ]
  },
  "processing_mode": "automatic",
  "description": "some description",
  "payer": {
    "entity_type": "individual",
    "email": "test_123@testuser.com",
    "first_name": "John",
    "last_name": "Doe",
    "identification": {
      "type": "CPF",
      "number": "15635614680"
    },
    "phone": {
      "area_code": "55",
      "number": "99999999999"
    },
    "address": {
      "street_name": "R. Ângelo Piva",
      "street_number": "144",
      "zip_code": "06210110",
      "neighborhood": "Presidente Altino",
      "city": "Osasco",
      "state": "SP",
      "complement": "303"
    }
  },
  "marketplace": "NONE",
  "marketplace_fee": "10.00",
  "items": [
    {
      "title": "Some item title",
      "unit_price": "1000.00",
      "quantity": 1,
      "description": "Some item description",
      "external_code": "item_external_code",
      "category_id": "category_id",
      "type": "item type",
      "picture_url": "https://mysite.com/img/item.jpg"
    }
  ],
  "expiration_time": "P3D"
}
``` 