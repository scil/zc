
# front end
https://github.com/MoOx/pjax

# server
use two layout `base.blade.php` and `basetrue.blade.php` for normal or pjax request

use this view var to mark requests.
\View::share('IS_PJAX', $this->app->make('request')->header('x-pjax', ''));
