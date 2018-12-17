<?php
/**
 *
 *
 * @link          https://github.com/mzm-dev 
 * @demo          http://highcharts-mzm.rhcloud.com
 * @created       September 2014
 * @fb            https://www.facebook.com/zakimedia
 * @email         mohdzaki04@gmail.com
 */
$cakeDescription = "Highcharts Pie Chart";
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
      
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                //default
                getAjaxData('2016');

                $('#dynamic_data').change(function() {
                    var id = $('#dynamic_data').val();
                    getAjaxData(id);
                });

                var options = {
                    chart: {
                        renderTo: 'container',
                        type: 'column'
                    },
                    title: {
                         text: 'Data Pelanggaran Siswa',
                        x: -20 //center
                    },
                    
                    xAxis: {
                        categories: [],
                         title: {
                            text: 'Semester'
                        },
                         crosshair: true 
                   },
                    yAxis: {
                          min: 0,
                        title: {
                            text: 'Jumlah Pelanggaran'
                        },
                        
                    },
               tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span><b>{point.y}</b> Pelanggaran <br/>'
                    },
     plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y}'
                            }
                        }
                    },
                     
                    series: []
                };
                function getAjaxData(id) {
                    $.getJSON("<?php echo site_url('c_home/tes'); ?>", {year: id}, function(json) {
                        options.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
                        options.series[0] = json[1];    
                        options.series[1] = json[2];
                        options.series[2] = json[3];
                        options.series[3] = json[4];
                        var year = parseInt(id)
                        var nextyear = year+1;
                       console.log(nextyear);
                        chart = new Highcharts.Chart(options);
                        chart.setTitle({ text: 'Data Pelanggaran Siswa Tahun Ajaran ' + id +'/'+ nextyear });
                        
                    });
                }

            });
        </script>
        <script src="<?php echo base_url(); ?>js/highchart/highcharts.js"></script>
<script src="<?php echo base_url(); ?>js/highchart/exporting.js"></script>
  <!--<link rel="stylesheet" href="css/unicorn.css" />-->

        
    </head>
    <body>
        <div class="form-group">
      <label class="col-sm-3 col-md-3 col-lg-2 control-label">Tahun Ajaran</label>
	<div class="col-sm-9 col-md-9 col-lg-10">
	<select id="dynamic_data">
                <option>Pilih Tahun Ajaran</option>
                <?php foreach ($list_tahun as $value) {
                $year =  $value['year'];
                $nextYear = $year + 1;
                    ?>
                <option value="<?php echo $year;?>"><?php echo $year.'/'.$nextYear; ?></option>
                <?php }?>
            </select>
        </div>
        </div>									
            
            <br/>
        
        <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto;"></div>
    </body>
</html>
