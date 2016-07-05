
<h2  class="titre">{titre_evenement}</h2>

<p  class="texte">{date}</p>

<div>
    
    <div>
        <h3>{LANG_lien_pour_participer}</h3>
        <textarea cols="100" rows="2">{SITE_nom_site}/index.php?a=carte&include=default&m={code}</textarea>
    </div>

    <div>
        <h3>{LANG_creer_evenement_bouton_automatique}</h3>
        <div>
            <a href='{SITE_nom_site}/index.php?a=carte&include=default&m={code}' target='_blank'>
                <img src='./image/share.gif' alt='Wigowiz, le covoiturage de vos événements' title='Wigowiz, le covoiturage de vos événements' border='0' />
            </a>
        </div>

        <p>{LANG_creer_evenement_inserer}</p>

        <textarea cols="100" rows="5">
            <a href='{SITE_nom_site}/index.php?a=carte&amp;include=default&m={code}' target='_blank'>
                <img src='{SITE_nom_site}/image/share.gif' alt='Wigowiz, le covoiturage de vos événements' title='Wigowiz, le covoiturage de vos événements' />
            </a>
        </textarea>
    </div>
    
    <div>
        <h3>{LANG_creer_evenement_qrcode_titre}</h3>
        <p>
        <a href="/modules/qrcode/qrcode.php?carte={qrcode}&taille=5" title="{LANG_creer_evenement_qrcode_petit}" target="_blank">{LANG_creer_evenement_qrcode_petit}</a>
            <br />
            <a href="/modules/qrcode/qrcode.php?carte={qrcode}&taille=10" title="{LANG_creer_evenement_qrcode_moyen}" target="_blank">{LANG_creer_evenement_qrcode_moyen}</a>
            <br />
            <a href="/modules/qrcode/qrcode.php?carte={qrcode}&taille=15" title="{LANG_creer_evenement_qrcode_grand}" target="_blank">{LANG_creer_evenement_qrcode_grand}</a>
        </p>
        <img src="./modules/qrcode/qrcode.php?carte={qrcode}&taille=5" width="160px" height="160px" alt="{LANG_creer_evenement_qrcode_titre}"  />
    </div>

</div>

<div>
    <p>{LANG_faq2_texte}</p>

</div>
          
