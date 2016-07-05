
        <h1>{titre}</h1>
        {alerte}
        <h2>{LANG_carte_titre_evenement} {titre_evenement}</h2>

        <p>{LANG_carte_date_evenement} {date_evenement}
            <br />
            {LANG_carte_cree_par} {createur_evenement}
        </p>
        
        <p>
            {description}
        </p>
        
        <h2>
            {texte_inscription}
        </h2>

        <div id="map"></div>

        <script src="./geojson/consulter_carte_{type}.php?id={id_evenement}"></script>
        <script src="./javascript/carte/consulter_carte_{type}.php?id={id_evenement}"></script>
