<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>DepotSystem | Bømlo Røde Kors</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/stilark.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">DepotSystem</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><?php echo anchor('/Utstyr/','Oversikt'); ?></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Utstyr <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><?php echo anchor('/Utstyr/Liste','Utstyrsliste'); ?></li>
                <li><?php echo anchor('/Utstyr/registrereutstyr','Registrere utstyr'); ?></li>
                <li role="separator" class="divider"></li>
                <li><?php echo anchor('/Utstyr/Produsenter','Produsenter'); ?></li>
                <li><?php echo anchor('/Utstyr/kategorier','Kategorier'); ?></li>
                <li><?php echo anchor('/Utstyr/Lagerplasser','Lagerplasser'); ?></li>
                <li><?php echo anchor('/Utstyr/Leverandorer','Leverandører'); ?></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Aktiviteter <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><?php echo anchor('/Aktiviteter/','Oversikt'); ?></li>
                <li role="separator" class="divider"></li>
                <li><?php echo anchor('/Aktiviteter/NyAktivitet','Ny aktivitet'); ?></li>
                <li><?php echo anchor('/Aktiviteter/NyUtstyrsliste','Ny utstyrsliste'); ?></li>
              </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Strekkode">
            </div>
            <button type="submit" class="btn btn-default">Finn</button>
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container-fluid">
      <?php if ($this->session->flashdata('Feilmelding')) { ?>
          <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('Feilmelding'); ?></div>
      <?php } ?>
      <?php if ($this->session->flashdata('Infomelding')) { ?>
          <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('Infomelding'); ?></div>
      <?php } ?>
      <?php echo $contents; ?>
    </div> <!-- /container -->

    <p class="footer">Side lastet på <strong>{elapsed_time}</strong> sekunder. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>


  </body>
</html>
