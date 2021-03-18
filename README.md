# FRT task

## Installation
```bash
- git clone git@github.com:tsitsishvili/FRT-task.git
- composer install
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan serve
```

## Usage

- Get Binary Questions. method GET /api/v1/binaryquestions
- Get Multi Choice Questions. method GET /api/v1/multichoicequestions

- Check Binary Question Answer. method POST /api/v1/checkbinaryanswer  with data [{"QuestionId":integer,"AnswerId":integer}]
- Check Multi Choice Question Answer. method POST /api/v1/checkmultichoicesanswer  with data [{"QuestionId":integer,"AnswerId":integer}]

- Save Binary Questions Statistics. method POST /api/v1/savebinarystatistics with data [{"Answers":"[{"QuestionId":integer,"AnswerId":integer},{...}...]}]"}]
- Save Multi Choice Questions Statistics. method POST /api/v1/savemultichoicestatistics with data [{"Answers":"[{"QuestionId":integer,"AnswerId":integer},{...}...]}]"}]

- Get Binary Questions Statistics. method GET  /api/v1/binarystatistics
- Get Multi Choice Questions Statistics. method GET  /api/v1/multichoicestatistics
