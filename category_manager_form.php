<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <link rel="shortcut icon" href="<?= VIEW_IMG_URL ?>favicon.png" type="image/png">

        <title>Choix prédéfinis / Gérer les choix</title>

        <link href="<?= VIEW_CSS_URL ?>style.css" rel="stylesheet"/>
        <link href="<?= VIEW_CSS_URL ?>style-responsive.css" rel="stylesheet"/>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="<?= VIEW_JS_URL ?>html5shiv.js"></script>
        <script src="<?= VIEW_JS_URL ?>respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <section>
            <div class="left-side sticky-left-side">
                <div class="logo">
                    <a href="<?= VIEW_ADMIN_URL ?>accueil/">
                        <img src="<?= VIEW_IMG_URL ?>logo.png" alt="">
                    </a>
                </div>
                <div class="logo-icon text-center">
                    <a href="<?= VIEW_ADMIN_URL ?>accueil/">
                        <img src="<?= VIEW_IMG_URL ?>logo_icon.png" alt="">
                    </a>
                </div>
                <div class="left-side-inner"><?= NavBuilder::process(); ?></div>
                </div>
            </div>
            <!-- left side end-->
            <!-- main content start-->
            <div class="main-content" >
				<!-- header section start-->
				<div class="header-section">
					<!--toggle button start-->
					<a class="toggle-btn"><i class="fa fa-bars"></i></a>
					<!--toggle button end-->
					<!--notification menu start -->
                    <div class="menu-right">
                        <div>Utilisateur : <?= $user_identity ?></div>
                    </div>
					<!--notification menu end -->
				</div>
				<!-- header section end-->
				<!-- page heading start-->
				<div class="page-heading">
					<div>Choix prédéfinis / Gérer les choix</div>
				</div>
				<!-- page heading end-->
                <!-- body wrapper start-->
                <div class="wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">Listes des choix prédéfinis</header>
                                <div class="panel-body">
                                    <section id="flip-scroll">
                                        <table class="table table-bordered table-striped table-condensed cf">
                                            <thead class="cf">
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">Type</th>
                                                    <th class="text-center">Valeur</th>
                                                    <th class="text-center">Affichage</th>
                                                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody><?= $content ?? null ?></tbody>
                                        </table>
                                    </section>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <!--body wrapper end-->
            	<!--footer section start-->
		        <footer class=""><?= FOOTER_TEXT ?></footer>
		        <!--footer section end-->
		    </div>
		    <!-- main content end-->
		</section>
        <!-- Placed js at the end of the document so the pages load faster -->
        <script src="<?= VIEW_JS_URL ?>jquery-1.10.2.min.js"></script>
		<script src="<?= VIEW_JS_URL ?>jquery-ui-1.9.2.custom.min.js"></script>
		<script src="<?= VIEW_JS_URL ?>jquery-migrate-1.2.1.min.js"></script>
        <script src="<?= VIEW_JS_URL ?>bootstrap.min.js"></script>
        <script src="<?= VIEW_JS_URL ?>modernizr.min.js"></script>
		<script src="<?= VIEW_JS_URL ?>jquery.nicescroll.js"></script>
		<!--common scripts for all pages-->
		<script src="<?= VIEW_JS_URL ?>scripts.js"></script>
    </body>
</html>
