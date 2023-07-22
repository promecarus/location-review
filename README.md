# Location Review API

This API allows you to submit and view location reviews.

The API is available at `http://127.0.0.1:8000/`

## Endpoints

### List of users

GET `/users`

Returns a list of users.

Optional query parameters:

- type: fiction or non-fiction
- limit: a number between 1 and 20.

### Get a single user

GET `/users/:id`

Retrieve detailed information about a user.

### Submit an order

POST `/orders`

Allows you to submit a new order. Requires authentication.

The request body needs to be in JSON format and include the following properties:

- `bookId` - Integer - Required
- `customerName` - String - Required

Example

```json
POST /orders/
Authorization: Bearer <YOUR TOKEN>

{
  "bookId": 1,
  "customerName": "John"
}
```

The response body will contain the order Id.

### Get all orders

GET `/orders`

Allows you to view all orders. Requires authentication.

### Get an order

GET `/orders/:orderId`

Allows you to view an existing order. Requires authentication.

### Update an order

PATCH `/orders/:orderId`

Update an existing order. Requires authentication.

The request body needs to be in JSON format and allows you to update the following properties:

- `customerName` - String

 Example

```json
PATCH /orders/PF6MflPDcuhWobZcgmJy5
Authorization: Bearer <YOUR TOKEN>

{
  "customerName": "John"
}
```

### Delete an order

DELETE `/orders/:orderId`

Delete an existing order. Requires authentication.

The request body needs to be empty.

 Example

```json
DELETE /orders/PF6MflPDcuhWobZcgmJy5
Authorization: Bearer <YOUR TOKEN>
```

## API Authentication

To submit or view an order, you need to register your API client.

POST `/api-clients/`

The request body needs to be in JSON format and include the following properties:

- `clientName` - String
- `clientEmail` - String

 Example

 ```json
{
    "clientName": "Postman",
    "clientEmail": "valentin@example.com"
}
 ```

The response body will contain the access token. The access token is valid for 7 days.
