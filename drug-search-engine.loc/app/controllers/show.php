<?
global $db;

//$sql = 'SELECT * FROM Medication_t';
//dump("Corr");
//$med = $db->query($sql)->findAll();


$med = valid($_GET['medication']);
//dump($med);
$title = $med;

$medication = getSearchMed($med, $db); // список данных о препарате
if($medication['id'] == 0):?>
    <!-- <script>
        const newDiv = $("<div/>", {
            class: "error-text",
            text: "Препарат не найден",
                }).appendTo("#error")
    </script>
     -->
<?
require_once CONTROLLERS.'/index.php';
endif;

$activeSubstances = $medication['activeSubstances']; // список активных веществ
$analogues = getAnaloguesList($medication['activeSubstances'], $medication['id'], $db); // список аналогов

// dump("id => ".$medication['id']);
// dump("name => ".$medication['name']);
// dump("country => ".$medication['country']);
// dump("form => ".$medication['form']);
// dump("price => ".$medication['price']);
// dump("dosage => ".$medication['dosage']);
// dump("dvalue => ".$medication['value']);
// dump($activeSubstances);

// dump("аналоги");
// dump($analogues);


require_once VIEWS.'/pages/show.tmpl.php';

?>