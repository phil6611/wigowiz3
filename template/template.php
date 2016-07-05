<!doctype html > 
<html  lang="{langue}"> 
    <head>
        <meta charset="utf-8" /> 
        <meta name="verify-v1" content="wIGL4nbq/k4R6zs66O673JcDJyiUUDCYlg4vElsF3nU=" />
        <meta name="description" content="{LANG_meta_description}" /> 
        <meta name="robots" content="index,follow" /> 
        <meta name="keywords" content="{LANG_meta_mots}" /> 

        <title>{LANG_meta_title}</title>

        <link rel="image_src"  href="http://wigowiz.addicterra.fr/image/logo_wigowiz.jpg"  />
        <link href="./styles/style.css" rel="stylesheet" type="text/css" />
        <!-- Styles pour JQuery UI -->
        <link rel="stylesheet" href="./styles/jquery-ui-themes-1.11.1/themes/smoothness/jquery-ui.min.css" type="text/css" />
        <link href="./styles/jquery.datetimepicker.css" rel="stylesheet" type="text/css"/>
        <!--Styles pour leaflet -->
        <link rel="stylesheet" href="./leaflet/leaflet.css" type="text/css" media="all" />
        <!-- Styles pour Datatable -->
        <link rel="stylesheet" type="text/css" href="./javascript/DataTables-1.10.10/media/css/jquery.dataTables.css">

        
        <!-- Fichier JavaScript pour Leaflet -->
        <script src="./leaflet/leaflet.js"></script>
        <!-- Google -->
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        
    </head>


    <body {body}>
        
        <noscript> 
            <p>{LANG_noscript}</p>
        </noscript>
        
        <div id="container">
            <div id="content">
                <header>
                    <div><a href="index.php"><img src="./image/logo.gif" alt="{LANG_meta_title}" title="{LANG_meta_title}"/></a></div>
                    <div class="baseline">
                        {LANG_baseline}
                    </div>
<!--
                    <div>
                        <a href="./modules/change_language/index.php?lang=fr"><img src="./image/flag_fr.gif" alt="Wigowiz en français" /></a>
                        <a href="./modules/change_language/index.php?lang=en"><img src="./image/flag_en.gif" alt="Wigowiz in english" /></a>
			<a href="?change_lang=us"><img src="./image/flag_us.gif"  /></a>
                        <a href="?change_lang=de"><img src="./image/flag_de.gif"  /></a>
                        <a href="?change_lang=es"><img src="./image/flag_es.gif"  /></a>
                        <a href="?change_lang=it"><img src="./image/flag_it.gif"  /></a>
                        <a href="?change_lang=sv"><img src="./image/flag_sv.gif"  /></a>
                    </div>
-->
                </header>
                
                {login}
                
                {menu_compte}
                
                {html}
                
                
                <footer>
                    <p class="basdepage">
                        <a href="index.php?a=contact" >{LANG_contact}</a>&nbsp;|&nbsp;
                        <a href="index.php?a=faq" >{LANG_FAQ}</a>&nbsp;|&nbsp;
                        <a href="index.php?a=conditions_utilisation" >{LANG_conditions_utilisation}</a>&nbsp;|&nbsp;
                        <a href="index.php?a=emissions_co2" >{LANG_emissions_co2}</a>&nbsp;|&nbsp;
                        <a href="index.php?a=bannieres" >{LANG_bannieres}</a>&nbsp;|&nbsp;
                        <a href="index.php?a=liens" >{LANG_liens}</a>
                    </p>
                    <p>
                        <span class="copy-left">&copy;</span> <a href="http://www.addicterra.fr" target="_blank" class="basdepage">www.addicterra.fr</a>
                    </p>
                </footer>

            </div>
        </div>

        <!-- Piwik -->
        <script type="text/javascript">
          var _paq = _paq || [];
          _paq.push(['trackPageView']);
          _paq.push(['enableLinkTracking']);
          (function() {
            var u="//piwik.addicterra.fr/";
            _paq.push(['setTrackerUrl', u+'piwik.php']);
            _paq.push(['setSiteId', 1]);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
          })();
        </script>
        <noscript><p><img src="//piwik.addicterra.fr/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
        <!-- End Piwik Code -->



    </body>

</html>