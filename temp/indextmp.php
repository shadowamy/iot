<?php
	//include 'database.php';
	header ("Content-Type:text/html; charset = utf-8");
	$temp = "";
	//$sql = "SELECT value FROM tempData LIMIT 24";
	//$result = mysqli_query($DATABASE_CONNECT, $sql);
	$count = 0;
	while ($count<15){
		$arr = exec("C:\Python27\python test2.py");
		$temp = $temp . $arr . ",";
		$count =$count+1;
	}
	//mysqli_free_result($result);
	//mysqli_close($DATABASE_CONNECT);
	$temp = substr($temp,0,-1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>419Lab</title>
    <!-- 引入 echarts.js -->
    <script src="./js/echarts.min.js"></script>
</head>
<body>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 100%;height:800px"></div>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
		var timeData = [
			'2017/7/24 00:00',
			'2017/7/24 01:00',
			'2017/7/24 02:00',
			'2017/7/24 03:00',
			'2017/7/24 04:00',
			'2017/7/24 05:00',
			'2017/7/24 06:00',
			'2017/7/24 07:00',
			'2017/7/24 08:00',
			'2017/7/24 09:00',
			'2017/7/24 10:00',
			'2017/7/24 11:00',
			'2017/7/24 12:00',
			'2017/7/24 13:00',
			'2017/7/24 14:00',
			'2017/7/24 15:00',
			'2017/7/24 16:00',
			'2017/7/24 17:00',
			'2017/7/24 18:00',
			'2017/7/24 19:00',
			'2017/7/24 20:00',
			'2017/7/24 21:00',
			'2017/7/24 22:00',
			'2017/7/24 23:00',
			];

		timeData = timeData.map(function (str) {
			return str.replace('2017/', '');
		});

		option = {
			title: {
				text: '419Lab\'s temperature and humidity',
				subtext: 'collect by raspberrypi',
				x: 'center'
		},
		tooltip: {
			trigger: 'axis',
			axisPointer: {
				animation: false
			}
		},
		legend: {
			data:['Temp','Humi'],
			x: 'left'
		},
		toolbox: {
			feature: {
				dataZoom: {
					yAxisIndex: 'none'
				},
				restore: {},
				saveAsImage: {}
			}
		},
		axisPointer: {
			link: {xAxisIndex: 'all'}
		},
		dataZoom: [
			{
				show: true,
				realtime: true,
				start: 30,
				end: 70,
				xAxisIndex: [0, 1]
			},
			{
				type: 'inside',
				realtime: true,
				start: 30,
				end: 70,
				xAxisIndex: [0, 1]
			}
		],
		grid: [{
			left: 50,
			right: 50,
			height: '35%'
		}, {
			left: 50,
			right: 50,
			top: '55%',
			height: '35%'
		}],
		xAxis : [
			{
				type : 'category',
				boundaryGap : false,
				axisLine: {onZero: true},
				data: timeData
			},
			{
				gridIndex: 1,
				type : 'category',
				boundaryGap : false,
				axisLine: {onZero: true},
				data: timeData,
				position: 'top'
			}
		],
		yAxis : [
			{
				name : 'Temp(C)',
				type : 'value',
				max : 50
			},
			{
				gridIndex: 1,
				name : 'Humi(%)',
				type : 'value',
				inverse: true
			}
		],
		series : [
			{
				name:'Temp',
				type:'line',
				symbolSize: 8,
				hoverAnimation: false,
				data:[
				//20,21,22,20,21,20,21,20,21,20,21,20,21,20,20,21,22,20,21,20,21,20,21,22
				<?php
					echo $temp;
				?>
				]
			},
			{
				name:'Humi',
				type:'line',
				xAxisIndex: 1,
				yAxisIndex: 1,
				symbolSize: 8,
				hoverAnimation: false,
				data: [
				30,31,32,36,32,31,32,31,32,31,32,34,32,31,36,32,36,31,31,35,35,33,31,31
			   ]
			}
		]
		};
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
</body>
</html>