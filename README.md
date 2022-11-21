# database
The Database package extend illuminate database


### Use
```
// index.php

use Larso\database\DatabaseService;

require 'vendor/autoload.php';

DatabaseService::boot([
	'username' => 'username',
	'password' => 'password',
	'database' => 'dbname'
]);
```

```
// YourClass.php

use Larso\Database\LaravelModel;

class YourClass extends LaravelModel {
	protected $table = 'table_name';
}
```

### Facade
```
use Larso\database\DB;

$results = DB::select('select * from users where id = ?', [1]);
```