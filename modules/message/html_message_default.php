
        <h1>{LANG_message_titre}</h1>

        <div id="message_liste">
            
            <table id="recu">
                
                <caption>{LANG_message_message_recu}</caption>
                
                <thead>
                    <tr>
                        <th>{LANG_message_date}</th>
                        <th>{LANG_message_sujet}</th>
                        <th>{LANG_message_expediteur}</th>
                        <th>{LANG_message_etat}</th>
                    </tr>
                </thead>
                
                <tbody>
{tableau_message_reçu}
                </tbody>
                
                <tfoot>
                    <tr>
                        <th>{LANG_message_date}</th>
                        <th>{LANG_message_sujet}</th>
                        <th>{LANG_message_expediteur}</th>
                        <th>{LANG_message_etat}</th> 
                    </tr>
                </tfoot>
                
            </table>

            <table id="emis">
                
                <caption>Messages émis</caption>
                
                <thead>
                    <tr>
                        <th>{LANG_message_date}</th>
                        <th>{LANG_message_sujet}</th>
                        <th>{LANG_message_destinaire}</th>
                    </tr>
                </thead>
                
                <tbody>
{tableau_message_emis}
                </tbody>
                
                <tfoot>
                    <tr>
                        <th>{LANG_message_date}</th>
                        <th>{LANG_message_sujet}</th>
                        <th>{LANG_message_destinaire}</th>
                    </tr>
                </tfoot>
                
            </table>
        </div>
    
        
        
        <!-- jQuery -->
        <script type="text/javascript" charset="utf8" src="./javascript/DataTables-1.10.10/media/js/jquery.js"></script>
        <!-- DataTables -->
        <script type="text/javascript" charset="utf8" src="./javascript/DataTables-1.10.10/media/js/jquery.dataTables.js"></script>
    
        <script>
            $(document).ready( function () {
                $('#recu').DataTable({

                    "order": [ 1, 'desc' ],
                    "language":{
                        "emptyTable":     "{LANG_message_datatable_empty}",
                        "info":           "{LANG_message_datatable_info}",
                        "infoEmpty":      "{LANG_message_datatable_infoEmpty}",
                        "infoFiltered":   "{LANG_message_datatable_infoFiltered}",
                        "infoPostFix":    "",
                        "thousands":      "{LANG_message_datatable_thousands}",
                        "lengthMenu":     "{LANG_message_datatable_lengthMenu}",
                        "loadingRecords": "{LANG_message_datatable_loadingRecords}",
                        "processing":     "{LANG_message_datatable_processing}",
                        "search":         "{LANG_message_datatable_search}",
                        "searchPlaceholder": "{LANG_message_datatable_searchPlaceholder_recu}",
                        "zeroRecords":    "{LANG_message_datatable_zeroRecords}",
                        "paginate": {
                            "first":      "{LANG_message_datatable_first}",
                            "last":       "{LANG_message_datatable_last}",
                            "next":       "{LANG_message_datatable_next}",
                            "previous":   "{LANG_message_datatable_previous}"
                        },
                        "aria": {
                            "sortAscending":  "{LANG_message_datatable_sortAscending}",
                            "sortDescending": "{LANG_message_datatable_sortDescending}"
                        }
                    }
                });
            } );
            
            $(document).ready( function () {
                $('#emis').DataTable({

                    "order": [ 1, 'desc' ],
                    "language":{
                        "emptyTable":     "{LANG_message_datatable_empty}",
                        "info":           "{LANG_message_datatable_info}",
                        "infoEmpty":      "{LANG_message_datatable_infoEmpty}",
                        "infoFiltered":   "(filtered from _MAX_ total entries)",
                        "infoPostFix":    "",
                        "thousands":      "{LANG_message_datatable_thousands}",
                        "lengthMenu":     "{LANG_message_datatable_lengthMenu}",
                        "loadingRecords": "{LANG_message_datatable_loadingRecords}",
                        "processing":     "{LANG_message_datatable_processing}",
                        "search":         "{LANG_message_datatable_search}",
                        "searchPlaceholder": "{LANG_message_datatable_searchPlaceholder_emis}",
                        "zeroRecords":    "{LANG_message_datatable_zeroRecords}",
                        "paginate": {
                            "first":      "{LANG_message_datatable_first}",
                            "last":       "{LANG_message_datatable_last}",
                            "next":       "{LANG_message_datatable_next}",
                            "previous":   "{LANG_message_datatable_previous}"
                        },
                        "aria": {
                            "sortAscending":  "{LANG_message_datatable_sortAscending}",
                            "sortDescending": "{LANG_message_datatable_sortDescending}"
                        }
                    }
                });
            } );
        </script>