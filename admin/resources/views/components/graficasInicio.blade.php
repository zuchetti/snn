<script>

"use strict";
var KTGoogleChartsDemo = function() {

    //Personal Médico
      var options = {
            series: [{
            name: 'Personal Médico',
            data: 
              <?php
              if($grafica->status==200){
                  $data=array();
                  foreach ($grafica->data->personalmedico as $item) {
                      array_push($data, $item->cuenta);              
                  }
                  $data=json_encode($data);
                  echo $data;
              }
              ?>         
            }],
            chart: {
            type: 'bar',
            height: 350
            },
            title: {
              text: 'Personal Médico',
              align: 'left'
            },
            plotOptions: {
              bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
              },
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
            },
           
            colors: ['#7bd6ff'], 
           
            fill: {
              opacity: 1
            },
          
      }

      var chart = new ApexCharts(document.querySelector("#kt_gchart_1"), options);
      chart.render();

      //Atenciones

      var options = {
        series: [{
            name: "Atenciones",
            data: 
            <?php
            if($grafica->status==200){
                $data=array();
                foreach ($grafica->data->atenciones as $req) {
                    array_push($data, $req->cuenta);              
                }
                $data=json_encode($data);
                echo $data;
            }
            ?>   
            }],
            chart: {
                height: 350,
                type: 'area',
                zoom: {
                  enabled: false
                  }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            colors: ['#00E396'],
                title: {
                text: 'Atenciones totales por mes',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            
        };

        var chart = new ApexCharts(document.querySelector("#kt_gchart_2"), options);
        chart.render();
      
}();



</script>