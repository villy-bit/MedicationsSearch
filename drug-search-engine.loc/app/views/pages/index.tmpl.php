<!DOCTYPE html>
<html lang="ru">


<head>
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'TITLE' ?></title>
    <base href="<?= PATH?>/">   <!-- присоединяет все относительные ссылки к этому адресу -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="/styles/main.css">

    <!-- подключение jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- подключение локального скрипта -->
    <script src="D:\OSPanel\home\drug-search-engine.loc\public\scripts\main.js"></script>
</head>

<body>

    <div class="wrapper">
       
        <header class="header">
            <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> -->
            <nav class="navbar navbar-expand-lg navbar-custom">
                <div class="container-fluid container">
                    <a class="navbar-brand" href="#"><b>Каталог лекарственных средств</b></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" style="color: rgb(229, 237, 245); margin-left: 20px; padding-top: 15px"  aria-current="page" href="/">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="main py-5 main-cust">
            
     
            <div class="container">
                <form id="search-form" action="medication" method="GET">  
                    <div style="margin-top: 130px;">
                        <h1 class="index-text"><?=$header ?></h1>
                        <input class="index-content form-control" style="padding: 10px; padding-left: 20px" id="medication" name="medication" value=""/>
                        <button type="submit" id="searchbtn" name="searchbtn" class="btn btn-outline-dark index-content" 
                                style="width: 80px; margin-left: 47%; margin-right: 50%; padding: 5px;" >Найти</button>
                    </div>
                </form>
            </div>

            <div id="error"></div>

        </main>

<?require_once COMPONENTS.'/footer.php';?>



<?
if(isset($_GET['search']))
{
    require CONTROLLERS.'/show.php';
}
?>
