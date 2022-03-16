# GAME API Case

## Projeyi docker ile calistirmak icin asagidaki adimlari sirasiyla uygulayiniz.

- Run `docker-compose build --pull --no-cache`

Projede database sistemi olarak REDIS kullanildi.

## API Kullanimi

### SIGNUP

```
URL: /api/v1/user/signup
Method: POST
HEADER: Content-Type: application/json
Parameters: 
{
    "username": "ilyas",
    "password": "123123"
}
Response: 
{
    "status": "success",
    "result": {
        "id": 2,
        "username": "ilyas",
        "password": "123123"
    },
    "timestamp": "2022-03-16 12:44:44"
}
```

### SIGNIN

```
URL: /api/v1/user/signin
Method: POST
HEADER: Content-Type: application/json
Parameters: 
{
    "username": "ilyas",
    "password": "123123"
}
Response: 
{
    "status": "success",
    "result": {
        "id": "1",
        "username": "ilyas"
    },
    "timestamp": "2022-03-16 12:44:44"
}
```

### ENDGAME

```
URL: /api/v1/endgame
Method: POST
HEADER: Content-Type: application/json
Parameters: 
{
    "Players": [
        {"id": 1, "score": 100},
        {"id": 2, "score": 200}
    ]
}
Response: 
{
    "status": "success",
    "result": [
        {
          "id": 1,
          "score": 100
        },
        {
          "id": 2,
          "score": 200
        }
    ],
    "timestamp": "2022-03-16 12:44:44"
}
```
#### Players objesi icerisinde gonderilen userID, rediste yoksa socore bilgisi redise eklenmez.

### LEADERBOARD

```
URL: /api/v1/leaderboard
Method: GET
Parameters: 
{
}
Response: 
{
    "status": "success",
    "result": [
        {
            "id": 1,
            "username": "ilyas",
            "rank": 500
        },
        {
            "id": 3,
            "username": "ilyas 3",
            "rank": 300
        },
        {
            "id": 2,
            "username": "ilyas 2",
            "rank": 200
        }
    ],
    "timestamp": "2022-03-16 12:44:44"
}
```
