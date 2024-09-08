# Submission Service

Laravel API for creating submission.

## Requirements
- docker
- composer

## Installation
Run the following command from the terminal:
```
./init.sh
```

## Run project
Run the following command from the terminal:
```
./vendor/bin/sail up
```

## Run tests
```
./vendor/bin/sail test
```

## Run queue
```
./vendor/bin/sail artisan queue:work
```

## Run migrate
```
./vendor/bin/sail artisan migrate
```

## API Endpoints

### Create Submission

- **Endpoint**: `POST api/submissions`
- **Description**: Create a new submission with the provided details.

#### Request Headers
- `Content-Type: application/json`

#### Request Body

The request body must be in JSON format and include the following fields:

| Field   | Type   |
|---------|--------|
| name    | string |
| email   | string |
| message | string |

#### Example Request
curl --location 'http://localhost:80/api/submissions' \
--header 'Content-Type: application/json' \
--data-raw '{
"name": "John Doe",
"email": "john.doe@example.com",
"message": "This is a test message."
}'
