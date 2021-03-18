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

- Get Binary Questions /api/v1/binaryquestions
- Get Multi Choice Questions /api/v1/multichoicequestions

- Check Binary Question Answer /api/v1/checkbinaryanswer
- Check Multi Choice Question Answer /api/v1/checkmultichoicesanswer

- Save Binary Questions Statistics /api/v1/savebinarystatistics
- Save Multi Choice Questions Statistics /api/v1/savemultichoicestatistics

- Get Binary Questions Statistics /api/v1/binarystatistics
- Get Multi Choice Questions Statistics /api/v1/multichoicetistics
