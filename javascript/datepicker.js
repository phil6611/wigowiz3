/*
 * Fonction JavaScript pour l'affichage des calendriers
 */

$(function() {
                $.datepicker.setDefaults(
                    $.datepicker.regional[ "fr" ]
                );
                $("#datepicker").datepicker({minDate: "-30", dateFormat: "yy-mm-dd"});
                $("#datepicker2").datepicker({minDate: "-30", dateFormat: "yy-mm-dd"});
                $('#timepicker').datetimepicker({
                    datepicker:false,
                    format:'H:i'
                });
                $('#timepicker2').datetimepicker({
                    datepicker:false,
                    format:'H:i'
                });
            });
            

