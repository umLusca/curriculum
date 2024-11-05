<?php

// URL de destino da requisição
$url = "https://api.iotebe.com/v2/spot/ng1vt/global_data/data";

// Inicializando cURL
$ch = curl_init($url);

// Definindo os headers, incluindo a chave x-api-key
$headers = [
	'x-api-key: g8mSakhl1j7hHLB8P5uVl3CBNdXNVYBUPU85Ld00'
];

// Definindo as opções do cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Executando a requisição
$response = curl_exec($ch);

// Verificando se houve erros
if (curl_errno($ch)) {
	echo 'Erro no cURL: ' . curl_error($ch);
} else {
	// Exibindo a resposta da requisição
	
    $data = json_decode($response, true);
    var_dump($data);
    foreach ($data as $sensor){
        echo $sensor["spot_id"]."<br>";
        echo $sensor["sensor_id"]."<br>";
        echo $sensor["temperature"]."<br>";
        echo $sensor["timestamp"]."<br>"."<br>"."<br>";
    }
}

// Fechando a conexão cURL
curl_close($ch);


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            --d-height: 25%;
            --d-left: 40%;
            --d-width: calc(74.5% - 5.5%);
            --d-bottom-1: 76%;
            --d-bottom-2: -25.5%;

            --u-top: 60%;
            --u-right-1: var(--d-bottom-1);
            --u-right-2: var(--d-bottom-2);
            --u-height: var(--d-width);
            --u-width: var(--d-height);
        }

        chart-layer {
            position: absolute;
            display: block;
            transform: translate(-50%, -50%);
        }

        chart-layer.u {
            top: var(--u-top);
            width: var(--u-width);
            height: var(--u-height);
        }

        chart-layer.d {

        }

        chart-layer.a {
            right: var(--u-right-1);
        }

        chart-layer.b {
            right: var(--u-right-2);
        }


        chart-container {
            overflow: hidden;
            aspect-ratio: 1/1;
            max-height: 100%;
            max-width: 100%;
            display: block;


        }

        chart {

            display: block;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body>

<div class="container ">
    <div class="">
        <div class="">
            <div id="linechart" style="height: 300px; width: 100%"></div>
        </div>

    </div>
    <div class="position-relative m-5">

        <chart-layer class="u a">
            <div class="d-flex h-100 justify-content-evenly flex-column">
                <chart-container>
                    <chart id="E1"></chart>
                </chart-container>
                <chart-container>
                    <chart id="E2"></chart>
                </chart-container>
                <chart-container>
                    <chart id="E3"></chart>
                </chart-container>
                <chart-container>
                    <chart id="E4"></chart>
                </chart-container>

                <chart-container>
                    <chart id="E5"></chart>
                </chart-container>
                <chart-container>
                    <chart id="E6"></chart>
                </chart-container>
                <chart-container>
                    <chart id="E7"></chart>
                </chart-container>
                <chart-container>
                    <chart id="E8"></chart>
                </chart-container>

            </div>
        </chart-layer>

        <chart-layer class="u b">
            <div class="d-flex h-100 justify-content-evenly flex-column">
                <chart-container>
                    <chart id="D1"></chart>
                </chart-container>
                <chart-container>
                    <chart id="D2"></chart>
                </chart-container>
                <chart-container>
                    <chart id="D3"></chart>
                </chart-container>
                <chart-container>
                    <chart id="D4"></chart>
                </chart-container>

                <chart-container>
                    <chart id="D5"></chart>
                </chart-container>
                <chart-container>
                    <chart id="D6"></chart>
                </chart-container>
                <chart-container>
                    <chart id="D7"></chart>
                </chart-container>
                <chart-container>
                    <chart id="D8"></chart>
                </chart-container>

            </div>
        </chart-layer>


        <img src="top-draw-aligned.png" alt="" style="width: 100%">
    </div>

</div>
<script>

    function resizeChart(svgElement, containerElement) {
        let svgWidth, svgHeight;

        const containerWidth = containerElement.clientWidth;
        const containerHeight = containerElement.clientHeight;
        if (!svgElement.data("originalSize")) {
            svgWidth = parseFloat(svgElement.width());
            svgHeight = parseFloat(svgElement.height());
            svgElement.data("originalSize", [svgWidth, svgHeight]);

        } else {
            [svgWidth, svgHeight] = svgElement.data("originalSize")
        }

        if (svgWidth === containerWidth) return;
        const widthScale = containerWidth / svgWidth;
        const heightScale = containerHeight / svgHeight;
        const scale = Math.min(widthScale, heightScale);
        svgElement.attr('viewBox', `0 0 ${svgWidth} ${svgHeight}`);
        svgElement.attr('width', svgWidth * scale);
        svgElement.attr('height', svgHeight * scale);
    }

    let defaultRenderer = {
        series: [
            {
                type: 'gauge',
                min: 30,
                max: 260,
                axisLine: {
                    lineStyle: {
                        width: 50,
                        color: [
                            [0.3, '#00c500'],
                            [0.7, '#b5b500'],
                            [1, '#930000']
                        ]
                    }
                },
                pointer: {
                    itemStyle: {
                        color: 'red'
                    }
                },
                anchor: {
                    show: true,
                    showAbove: true,
                    color: "red",
                    size: 25,
                    itemStyle: {
                        borderWidth: 10
                    }
                },
                axisTick: {
                    distance: -50,
                    length: 10,
                    lineStyle: {
                        color: '#fff',
                        width: 2
                    }
                },
                splitLine: {
                    distance: -50,
                    length: 30,
                    lineStyle: {
                        color: '#fff',
                        width: 5
                    }
                },
                axisLabel: {
                    color: 'black',
                    distance: 80,
                    fontSize: 25,
                },
                detail: {
                    valueAnimation: true,
                    formatter: '{value} Cº',
                    color: 'inherit',

                },
                data: [
                    {
                        value: 70
                    }
                ]
            }
        ]
    };


    let myChart = echarts.init($("#linechart")[0]);

    myChart.setOption({
        xAxis: {
            type: 'category',
            data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        },
        yAxis: {
            type: 'value'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#6a7985'
                }
            }
        },
        series: [
            {
                data: [820, 932, 901, 934, 1290, 1330, 1320],
                type: 'line',
                smooth: true,
                name: "E1",
            },
            {
                data: [820, 932, 901, 934, 1290, 1330, 1320],
                type: 'line',
                smooth: true,
                name: "E3",
                
            },
            {
                data: [820, 932, 901, 934, 1290, 1330, 1320],
                type: 'line',
                smooth: true,
                name: "E2",
                
            },
        ]
    });


    $(() => {
        $(window).on("resize", () => {

            $("chart").each((id, chart) => {
                let echart = echarts.getInstanceByDom(chart);
                resizeChart($(chart).find("svg"), chart);
            });
        });

        $("chart").each((id, chart) => {
            $(chart).attr("id", "chart-" + id);
            let echart = echarts.getInstanceByDom(chart)
            if (!echart) {
                echart = echarts.init(chart, "svg", {
                    height: 600,
                    width: 600,
                    renderer: 'svg',

                })
            }
            defaultRenderer && echart.setOption(defaultRenderer);
            resizeChart($(chart).find("svg"), chart);

        })
    })

</script>
</body>
</html>