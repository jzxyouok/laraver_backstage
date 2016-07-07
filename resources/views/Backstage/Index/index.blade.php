@extends('Backstage.Common.base')

@section('sidebar')

    <div id="main" style="width: 600px;height:400px;"></div>


@endsection

@section('script')
    {{--这是js代码。--}}
    <script src="{{asset('common/js/echarts.common.min.js')}}"></script>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '未来一周气温变化',
                subtext: '纯属虚构',
                textStyle:{
                    color:'#fff'
                }

            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data:['阅读量'],
                textStyle:{
                    color:'#fff'
                }
            },
            toolbox: {
                show: true,
                feature: {
                    dataZoom: {},
                    dataView: {readOnly: false},
                    magicType: {type: ['line', 'bar']},
                    restore: {},
                    saveAsImage: {}
                }
            },
            xAxis:  {
                type: 'category',
                boundaryGap: false,
                data: [
                    {value:'周一',
                    textStyle: {color: '#fff'}
                    },
                    {value:'周二',
                        textStyle: {color: '#fff'}
                    },
                    {value:'周三',
                        textStyle: {color: '#fff'}
                    },
                    {value:'周四',
                        textStyle: {color: '#fff'}
                    },
                    {value:'周五',
                        textStyle: {color: '#fff'}
                    },
                    {value:'周六',
                        textStyle: {color: '#fff'}
                    },
                    {value:'周日',
                        textStyle: {color: '#fff'}
                    },
                ]

            },
            yAxis: {
                type: 'value',
                axisLabel: {
                    formatter: '{value} °C',
                    textStyle: {color: '#fff'}
                }

            },
            series: [
                {
                    name:'阅读量',
                    type:'line',
                    data:[11, 11, 15, 13, 12, 10, 10],
                    markPoint: {
                        data: [
                            {type: 'max', name: '最大值'},
                            {type: 'min', name: '最小值'}
                        ]
                    },
                    markLine: {
                        data: [
                            {type: 'average', name: '平均值'}
                        ]
                    }
                }

            ]
        };


        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
@endsection