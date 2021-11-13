<?php

require_once __DIR__ . "/../view/service/InyectorScript.php";

class Pdf
{
    /**
     * Injecta en la página los scripts necesarios para
     * poder generar un documento pdf.
     * 
     * @return void
     */
    public static function incluir($nombreArchivo = 'documento.pdf')
    {
        $scripts = [
            '<script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/3.0.9/umd.js"
        integrity="sha512-Wu9XXg78PiNE0DI4Z80lFKlEpLq7yGjquc0I35Nz+sYmSs4/oNHaSW8ACStXBoXciqwTLnSINqToeWP3iNDGmQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>',
            '<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>',

            '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.min.js">
    </script>',
            '<script type="text/javascript" src="https://cdn.jsdelivr.net/canvg/1.4.0/canvg.min.js"></script>',
            '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>',
            "<script>
    $('#btnToPdf').click(() => {
        var pdf = new jsPDF('landscape', 'pt', 'a4');
        var output = document.getElementById('docToPdf')
        pdf.addHTML(output, function() {
            pdf.save('$nombreArchivo');
        });
    })
    </script>"
        ];

        foreach ($scripts as $script) {

            InyectorScript::getInstancia()->agregarScript($script);
        }
    }
}