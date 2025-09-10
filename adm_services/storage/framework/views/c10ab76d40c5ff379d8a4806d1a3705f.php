<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receta</title>
    <style>
        table  {border-collapse:collapse;border-spacing:0;}
        .p{
            
            font-family:'Arial','sans-serif';
            margin:0;
            font-size:13px;
            padding: 0 3px;
        }
        .verde{
            color:#01a851;
        }
        .strong{
            font-weight:800;
        }
    </style>
</head>
<body>
<img src="<?php echo e(public_path('../../sanna.png')); ?>" alt="">

    <table style="width:100%">
        <tr style="">
            <td style="width:50%;border-right:1px solid #01a851;height:400px">
                <table>
                     <tr>
                        <td></td>
                     </tr>
                </table>
                <table style="width:100%">
                    <tr  >
                        <td style="border-top:4px solid #01a851;border:1px  solid #01a851">
                            <p class="p strong verde">Orden médica</p>
                        </td>
                    </tr>
                    <tr  >
                        <td style="border:1px solid  #01a851">
                            <table style="width:100%">
                                 <tr>
                                    <td style="width:50%;"><p class="p verde">EPS ( )  PPS ( )             </p></td>
                                    <td style="width:50%;"><p class="p verde" style="width:100%;text-align:right">N° Orden</p></td>
                                 </tr>
                            </table>
                        </td>
                    </tr>
                    <tr  >
                        <td style="border:1px solid  #01a851">
                            <p class="p verde">Apellidos y Nombres</p>
                        </td>
                    </tr>
                    <tr  >
                        <td style="border:1px solid  #01a851">
                            <p class="p verde">Código Afiliado</p>
                        </td>
                    </tr>
                    <tr  >
                        <td style="border:1px solid #01a851">
                            <p class="p verde">Sede</p>
                        </td>
                    </tr>
                </table>
            </td>px
            <td style="width:50%">
            
            </td>
        </tr>
    </table>
</body>
</html><?php /**PATH C:\Eureka\htdocs\sanna\adm_services\resources\views/receta.blade.php ENDPATH**/ ?>