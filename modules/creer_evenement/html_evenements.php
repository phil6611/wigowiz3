
        <h1>{LANG_mes_evenements}</h1>

        <div>
            <!-- les événements crées par l'internaute -->
            <form action="./index.php?a=compte&section=supprimer_evenement" method="post">
                
                <table class="display"  id="creation">
                    <caption>{{LANG_liste_evenement_creer}}</caption>

                    <thead>
                        <tr>
                            <th>
                                {{LANG_liste_evenement_supprimer}}
                            </th>
                            <th>
                                {{LANG_liste_evenement_modifier}}
                            </th>
                            <th>
                                {{LANG_liste_evenement_titre}}
                            </th>
                            <th>
                                {{LANG_liste_evenement_nbr_participant}}
                            </th>
                            <th>
                                {{LANG_liste_evenement_date}}
                            </th>
                            <th>
                                {{LANG_liste_evenement_statistiques}}
                            </th>
                            <th>
                                {{LANG_liste_evenement_description}}
                            </th>
                        </tr>
                    </thead>
            
                    <tbody>
                        
                        {evenements_creer}
                        
                    </tbody>
            
                </table>
                
                <div>
                    <label for="supprimer">{{LANG_liste_evenement_bouton_supprimer_label}}</label>
                    <input type="submit" value="{{LANG_liste_evenement_bouton_supprimer}}" id="supprimer" />
                    <input type="hidden" name="desinscrire" value="TRUE" />
                </div>
                
            </form>
            
        </div>
        
        <hr />
        
        <div>
            <!-- les événements auxquels l'internaute est inscrit -->
            <form action="./index.php?a=compte&section=desinscription" method="post">
                
                <table class="display" id="participe">
            
                    <caption>{{LANG_liste_evenement_participer}}</caption>
            
                    <thead>
                        <tr>
                            <th>
                                {{LANG_liste_evenement_se_desinscrire}}
                            </th>
                            <th>
                                {{LANG_liste_evenement_titre}}
                            </th>
                            <th>
                                {{LANG_liste_evenement_date}}
                            </th>
                            <th>
                                {{LANG_liste_evenement_description}}
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        
                        {evenements_participer}
                        
                    </tbody>
            
            
                </table>
                
                <div>
                    <label for="supprimer">{{LANG_liste_evenement_bouton_desinscrire_label}}</label>
                    <input type="submit" value="{{LANG_liste_evenement_bouton_desinscrire}}" id="supprimer" />
                    <input type="hidden" name="desinscrire" value="TRUE" />
                </div>
                
            </form>
        </div>
        
        
        <!-- jQuery -->
        <script type="text/javascript" charset="utf8" src="./javascript/DataTables-1.10.10/media/js/jquery.js"></script>
        <!-- DataTables -->
        <script type="text/javascript" charset="utf8" src="./javascript/DataTables-1.10.10/media/js/jquery.dataTables.js"></script>

        <script>
            $(document).ready( function () {
                $('#creation').DataTable({
                    "scrollY": "350px",
                    "scrollCollapse": true,
                    "paging": true,
                
                    "order": [ 4, 'desc' ],
                    "language":{
                        "emptyTable":     "Aucun événement trouvé",
                        "info":           "Événement _START_ à _END_ sur _TOTAL_ événements",
                        "infoEmpty":      "Événement 0 à 0 sur 0 événement",
                        "infoFiltered":   "(filtered from _MAX_ total entries)",
                        "infoPostFix":    "",
                        "thousands":      " ",
                        "lengthMenu":     "Afficher _MENU_ événements",
                        "loadingRecords": "Loading...",
                        "processing":     "Processing...",
                        "search":         "Rechercher&#8239;:",
                        "searchPlaceholder": "Rechercher un événement",
                        "zeroRecords":    "Aucun événement trouvé",
                        "paginate": {
                            "first":      "Première page",
                            "last":       "Dernière page",
                            "next":       "Page suivante",
                            "previous":   "Page précédente"
                        },
                        "aria": {
                            "sortAscending":  ": activer pour trier la colonne par ordre croissant",
                            "sortDescending": ": activer pour trier la colonne par ordre décroissant"
                        }
                    },
                });
            } );
            
            $(document).ready( function () {
                $('#participe').DataTable({
                    "scrollY": "350px",
                    "scrollCollapse": true,
                    "paging": true,
                
                    "order": [ 1, 'desc' ],
                    "language":{
                        "emptyTable":     "Aucun événement trouvé",
                        "info":           "Événement _START_ à _END_ sur _TOTAL_ événements",
                        "infoEmpty":      "Événement 0 à 0 sur 0 événement",
                        "infoFiltered":   "(filtered from _MAX_ total entries)",
                        "infoPostFix":    "",
                        "thousands":      " ",
                        "lengthMenu":     "Afficher _MENU_ événements",
                        "loadingRecords": "Loading...",
                        "processing":     "Processing...",
                        "search":         "Rechercher&#8239;:",
                        "searchPlaceholder": "Rechercher un événement",
                        "zeroRecords":    "Aucun événement trouvé",
                        "paginate": {
                            "first":      "Première page",
                            "last":       "Dernière page",
                            "next":       "Page suivante",
                            "previous":   "Page précédente"
                        },
                        "aria": {
                            "sortAscending":  ": activer pour trier la colonne par ordre croissant",
                            "sortDescending": ": activer pour trier la colonne par ordre décroissant"
                        }
                    },
                });
            } );
        </script>