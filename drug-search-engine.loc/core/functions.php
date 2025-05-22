<?

function dump($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function dd($data)
{
    dump($data);
    die;
}

function abort($err = 404)
{
    http_response_code($err);
    require_once VIEWS."/components/errors/{$err}.php";
}


function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

function strl($str)
{
    return mb_strlen($str, 'UTF-8');
}

function redirect($path='')
{
    if($path)
    {
        $redirect = $path;
    }
    else
    {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: {$redirect}");
    die;
}

function valid($str)
{
    $lowstr = strtolower($str); //перевод строки в нижний регистр
    $first = substr($lowstr, 0, 1); //первая буква
    $firststr = strtoupper($first); //перевод первого символа строки в верхний регистр
    $newstr = str_replace( $first, $firststr, $lowstr);
    return $newstr;
}



//поиск препарата в базе данных
//отправляем в show.php
function getSearchMed($med, $db) 
{
    $sql = 'SELECT * FROM Medication_t';
    $medications = $db->query($sql)->findAll();

    $object = [
            'id' => 0,
            'name' => 0,
            'country' => 0,
            'form' => 0,
            'price' => 0,
            'dosage' => 0,
            'value' => 0,
            'activeSubstances' => 0,
            'image' => 0
    ];
    foreach ($medications as $medication) 
    {
        if($medication['Name'] == $med)
        {
            $country = getCountry($medication['Country_id'], $db);
            $form = getFormType($medication['FormType_id'], $db);
            $dosage = getDosageType($medication['DosageType_id'], $db);
            $object = [
                'id' => $medication['id'],
                'name' => $medication['Name'],
                'country' => $country,
                'form' => $form,
                'price' => $medication['Price'],
                'dosage' => $dosage,
                'value' => $medication['DosageValue'],
                'activeSubstances' => getActionSubList($medication['id'], $db),
                'image' => './image/'.$medication['image']
            ];
            break;
        }
    }
    return $object;
}

//получение списка активных веществ
function getActionSubList($id_med, $db) 
{
    $sql = "SELECT * FROM MedicationActiveSubstance_t WHERE Medication_id = $id_med";
    $medSubstances = $db->query($sql)->findAll();
    $sql = "SELECT * FROM ActiveSubstance_t";
    $substances = $db->query($sql)->findAll();
    $substance = [];

    for ($i=0; $i < count($medSubstances); $i++) 
    { 
        for ($j=0; $j < count($substances); $j++) 
        { 
            if($substances[$j]['id'] == $medSubstances[$i]['Substance_id'])
            {
                array_push($substance, $substances[$j]);
            }
        }
    }

    return $substance;
}


//получение списка аналогов
//отправляем в show.php
function getAnaloguesList($substance, $medId, $db) 
{
    $sql = "SELECT * FROM MedicationActiveSubstance_t";
    $medSubstances = $db->query($sql)->findAll(); //список MedicationActiveSubstance_t
    $sql = "SELECT * FROM Medication_t"; 
    $medications = $db->query($sql)->findAll(); //список Medication_t

    $SubMedication = []; //список Medication_t для конкретной субстанции
    $analog = []; //список id аналогов


    for ($i=0; $i < count($substance); $i++) 
    { 
        for ($j=0; $j < count($medSubstances); $j++) 
        {
            if($medSubstances[$j]['Substance_id'] == $substance[$i]['id'])
            {
                array_push($SubMedication, $medSubstances[$j]['Medication_id']);
            }
        }
    }

    for ($i=0; $i < count($SubMedication); $i++) 
    { 
        for ($j=0; $j < count($medications); $j++) 
        {
            if($medications[$j]['id'] == $SubMedication[$i] && $medications[$j]['id'] != $medId)
            {
                array_push($analog, $medications[$j]);
            }
        }
    }

    $object = [
        'id' => 0,
        'name' => 0,
        'image' => 0
    ];

    $analogues = [];
    for ($i=0; $i < count($analog); $i++) 
    { 
        $object = [
            'id' => $analog[$i]['id'],
            'name' => $analog[$i]['Name'],
            'image' => './image/'.$analog[$i]['image']
        ];
        array_push($analogues, $object);
    }

    return $analogues;
}


function getCountry($Country_id, $db) 
{
    $sql = "SELECT Name FROM ProducingCountry_t WHERE id = $Country_id";
    $countries = $db->query($sql)->findAll();
    foreach ($countries as $key) {
        $country = $key['Name'];
        break;
    }
    return $country;
}
function getFormType($FormType_id, $db) 
{
    $sql = "SELECT * FROM FormType_t WHERE id = $FormType_id";
    $formTypes = $db->query($sql)->findAll();
    foreach ($formTypes as $key) {
        $formType = $key['Description'];
        break;
    }
    return $formType;
}
function getDosageType($DosageType_id, $db) 
{
    $sql = "SELECT * FROM DosageType_t WHERE id = $DosageType_id";
    $dosageTypes = $db->query($sql)->findAll();
    foreach ($dosageTypes as $key) {
        $dosageType = $key['Description'];
        break;
    }
    return $dosageType;
}

?>
