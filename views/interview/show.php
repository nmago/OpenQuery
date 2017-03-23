<h1><?=$iv['ivtext']?></h1>
<?php foreach($ivoptions as $opt): ?>
    <span style="font-size: 20px"><?=$opt['opttext']?> <span style="color: forestgreen"><?=$opt['vcount']?> голос(а)</span></span> <br/>

<?php endforeach; ?>

<hr/>

<h2><span style="color:darkblue"><?=$ivlikescount['likes']?> чел. нравится </span>/ <span style="color:darkred"><?=$ivlikescount['dislikes']?> чел. не нравится</span>
<br/><br/><span style="color:#112233; font-size:14px;">Последняя оценка проставлена <span class="need_refresh" data="<?=$lastliketime ?>"></span></span>
</h2>

<hr/>

<div id="ivchart"></div>

<script type="text/javascript" src="<?php echo SITEURL?>/js/Highcharts/highcharts.js"></script>

<script type="text/javascript">
    var options = [
        <?php
            for($i=0; $i<count($ivoptions); $i++){
               echo $i == count($ivoptions)-1 ? '\''.$ivoptions[$i]['opttext'].'\'' : '\''.$ivoptions[$i]['opttext'].'\',';
            }
        ?>
    ];

    var optionsVoteCount = [
        <?php
            for($i=0; $i<count($ivoptions); $i++){
               echo $i == count($ivoptions)-1 ? $ivoptions[$i]['vcount'] : $ivoptions[$i]['vcount'].',';
            }
        ?>
    ];

    var ivCountChartData = [];
    for(var i = 0; i < options.length; i++){
        ivCountChartData[i] = [options[i], optionsVoteCount[i]];
    }
    console.log(ivCountChartData);
    $(document).ready(function(){

        $('#ivchart').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Распределение голосов'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y} голосов | {point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: <span style="color:grey">{point.y} голосов | {point.percentage:.1f} %</span>',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Слов',
                data: ivCountChartData
            }]
        });

    })
</script>
