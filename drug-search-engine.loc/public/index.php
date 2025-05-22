<?

require_once dirname(__DIR__).'/config/config.php';

require_once CORE.'/functions.php';
require_once CLASSES.'/DB.php';

$db_config = require_once CONFIG.'/db.php';
$db = (DB::getInstanse())->getConnection($db_config);

require_once CLASSES.'/Router.php';
$router = new Router();

require_once CONFIG.'/routes.php';
$router->match();

?>