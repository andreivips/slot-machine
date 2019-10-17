# PHP
# Slots Turn Generator Command in Lumen

output the required format only,
less dynamic setups or unrequired on this stage dependencies

### file location: 
```
slots\app\Console\Commands\Slot.php
```

### command bind in slots\app\Console\Kernel.php: 
```
  ...
  protected $commands = [
    Commands\Slot::class,
  ];
  ...
```

### call in terminal (in app root):
```
php artisan slots:play
```

### output example as JSON: 
```
  {
    "board": [
      "j",
      "j",
      "k",
      "10",
      "bird",
      "10",
      "9",
      "bird",
      "monkey",
      "9",
      "dog",
      "dog",
      "9",
      "monkey",
      "9"
    ],
    "paylines": [
      {
        "0 3 6 9 12": 3
      }
    ],
    "bet_amount": 100,
    "total_win": 20
  }
```
