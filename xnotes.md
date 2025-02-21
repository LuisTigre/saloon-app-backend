# API Documentation

## Authentication

### Register

**Endpoint:** `POST /api/register`

**Description:** Registers a new user.

**Headers:**

- `Content-Type: application/json`

**Request Body:**

```json
{
    "name": "John Doe",
    "email": "johndoe@example.com",
    "password": "SecurePassword123",
    "password_confirmation": "SecurePassword123",
    "role": "client"
}
```

**Response:**

- `201 Created` on success
- `422 Unprocessable Entity` on validation errors

### Login

**Endpoint:** `POST /api/login`

**Description:** Logs in a user.

**Headers:**

- `Accept: application/json`
- `Content-Type: application/json`

**Request Body:**

```json
{
    "email": "admin@example.com",
    "password": "password123"
}
```

**Response:**

- `200 OK` on success with access token
- `401 Unauthorized` on incorrect credentials

### Logout

**Endpoint:** `POST /api/logout`

**Description:** Logs out the currently authenticated user.

**Headers:**

- `Authorization: Bearer {access_token}`
- `Accept: application/json`

**Response:**

- `200 OK` on success
- `401 Unauthorized` if not authenticated

## Braiding Styles

### Create Braiding Style

**Endpoint:** `POST /api/braiding-styles`

**Description:** Adds a new braiding style.

**Headers:**

- `Content-Type: application/json`
- `Authorization: Bearer {access_token}`

**Request Body:**

```json
{
    "style_name": "Cornrows",
    "description": "A traditional style with small braids.",
    "duration": 60,
    "price": 29.99
}
```

**Response:**

- `201 Created` on success
- `401 Unauthorized` if not authenticated

### Get Braiding Style

**Endpoint:** `GET /api/braiding-styles/{id}`

**Description:** Retrieves a specific braiding style by ID.

**Headers:**

- `Content-Type: application/json`
- `Authorization: Bearer {access_token}`

**Response:**

- `200 OK` on success
- `404 Not Found` if the style does not exist

### Update Braiding Style

**Endpoint:** `PUT /api/braiding-styles/{id}`

**Description:** Updates a specific braiding style.

**Headers:**

- `Content-Type: application/json`
- `Authorization: Bearer {access_token}`

**Request Body:**

```json
{
    "style_name": "Box Braids",
    "description": "A stylish braided hairstyle.",
    "duration": 75,
    "price": 39.99
}
```

**Response:**

- `200 OK` on success
- `404 Not Found` if the style does not exist

### Delete Braiding Style

**Endpoint:** `DELETE /api/braiding-styles/{id}`

**Description:** Deletes a specific braiding style.

**Headers:**

- `Authorization: Bearer {access_token}`

**Response:**

- `200 OK` on success
- `404 Not Found` if the style does not exist

## Bookings

### Get All Bookings

**Endpoint:** `GET /api/bookings`

**Description:** Retrieves all bookings.

**Headers:**

- `Accept: application/json`
- `Authorization: Bearer {access_token}`

**Response:**

- `200 OK` on success
- `401 Unauthorized` if not authenticated

### Create Booking

**Endpoint:** `POST /api/bookings`

**Description:** Creates a new booking.

**Headers:**

- `Accept: application/json`
- `Authorization: Bearer {access_token}`
- `Content-Type: application/json`

**Request Body:**

```json
{
    "customer_id": 1,
    "style_id": 2,
    "appointment_date": "2025-02-21",
    "start_time": "10:00",
    "end_time": "11:00",
    "total_price": 50.00,
    "status": "Pending",
    "attribute_values": [1, 2, 3]
}
```

**Response:**

- `201 Created` on success
- `401 Unauthorized` if not authenticated

### Get Booking by ID

**Endpoint:** `GET /api/bookings/{id}`

**Description:** Retrieves a specific booking by ID.

**Headers:**

- `Accept: application/json`
- `Authorization: Bearer {access_token}`

**Response:**

- `200 OK` on success
- `404 Not Found` if the booking does not exist

### Update Booking

**Endpoint:** `PUT /api/bookings/{id}`

**Description:** Updates a specific booking.

**Headers:**

- `Accept: application/json`
- `Authorization: Bearer {access_token}`
- `Content-Type: application/json`

**Request Body:**

```json
{
    "customer_id": 1,
    "style_id": 2,
    "appointment_date": "2025-02-21",
    "start_time": "10:00",
    "end_time": "11:00",
    "total_price": 50.00,
    "status": "Confirmed",
    "attribute_values": [1, 2, 3]
}
```

**Response:**

- `200 OK` on success
- `404 Not Found` if the booking does not exist

### Delete Booking

**Endpoint:** `DELETE /api/bookings/{id}`

**Description:** Deletes a specific booking.

**Headers:**

- `Accept: application/json`
- `Authorization: Bearer {access_token}`

**Response:**

- `200 OK` on success
- `404 Not Found` if the booking does not exist

## Testing

### Run Authentication Tests

**Command:**

```bash
php artisan test --filter AuthTest
```

**Additional Information:**

- Ghost Inspector Test ID: 787971547
- Ensure to replace `{access_token}` with the actual bearer token obtained from the login response.
- Endpoints requiring authentication return `401 Unauthorized` if the token is missing or invalid.
- JSON responses include error messages and validation details when applicable.
