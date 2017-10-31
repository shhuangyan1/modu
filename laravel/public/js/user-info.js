$(function () {

    var user_add_option = {
        title: {
            text: '会员增长走势图'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:['会员增长走势图']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['10-01','10-02','10-03','10-04','10-05','10-06','10-07','10-08','10-09','10-10','10-01','10-02','10-03','10-04','10-05','10-06','10-07','10-08','10-09','10-10']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name:'当日会员增长量',
                type:'line',
                stack: '',
                data:[42, 88, 93, 34, 190, 13, 140, 45, 20, 48,42, 85, 92, 94, 190, 130, 140, 105, 420, 448]
            }
        ]
    }

    var analyse_sex_option = {
        title : {
            text: '会员性别占比统计图',
        },
        color: ['#61A0A8', '#C23531', '#2F4554'],
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'right',
            data: []
        },
        series : [
            {
                name: '性别',
                type: 'pie',
                radius : '85%',
                center: ['50%', '50%'],
                data:[],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    }

    var analyse_area_option = {
        title: {
            text: '会员区域分布统计图'
        },
        color: ['#3398DB'],
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis : [
            {
                type : 'category',
                data : ['江苏', '上海', '浙江', '福建', '湖南', '湖北', '河北', '山西','江苏', '上海', '浙江', '福建', '湖南', '湖北', '河北', '山西'],
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'人数',
                type:'bar',
                barWidth: '60%',
                itemStyle : { normal: {label : {show: true, position: 'top'}}},
                data:[10, 52, 200, 34, 30, 330, 220, 50, 100, 52, 210, 314, 190, 339, 150, 59]
            }
        ]
    }

    // user_add_option
    var user_add_chart = echarts.init(document.getElementById("user-add-line"))
    var user_sex_chart = echarts.init(document.getElementById("user-sex-pie"))
    var user_area_chart = echarts.init(document.getElementById("user-area"))


    // 用户数据增长
    var show_user_add = function (range) {
        user_add_chart.showLoading()
        var now = Math.round(new Date() / 1000);
        var before_tenDays = MD.date_format(MD.time_format(now - 864000).split(" ")[0]);   // 十天前的0点
        range = MD.merger({'from': before_tenDays, 'to': now},range)
        console.log(range) //

        MD.ajax_get({
            url: "admin/user/run_chart",
            data: range
        }, function (res) {
            var list = res.result;
            var x = [], y = [];
            // 数据处理
            $.each(list, function (i, v) {
                x.push(i);
                y.push(v);
            })

            user_add_option.xAxis.data = x;
            user_add_option.series[0].data = y;
            user_add_chart.hideLoading();
            user_add_chart.setOption(user_add_option)
        })
    }
//https://mp.weixin.qq.com/s/yjhqXyNABZ1n7IbNwb95yA
    // 用户性别分析
    var show_user_sex = function () {
        user_sex_chart.showLoading()
        MD.ajax_get({url: "admin/user/user_piechart"}, function (res) {
            var list = res;
            var legend = [], series = [];
            for(var i in list){
                var cof = {"value": list[i].num, "name": MD.sex_format(list[i].gender)}
                series.push(cof)
                legend.push(MD.sex_format(list[i].gender))
            }

            analyse_sex_option.series[0].data = series;
            analyse_sex_option.legend.data = legend;
            user_sex_chart.hideLoading();
            user_sex_chart.setOption(analyse_sex_option)
        })
    }

    // 用户区域分析
    var show_user_area = function () {
        user_area_chart.showLoading();
        MD.ajax_get({url: "admin/user/area_barchart"}, function (res) {
            var list = res, arr = [];
            var xAxis = [], series = [];
            var no_prov = {"province": "未知", "num": 0},
                foreign = {"province": "海外", "num": 0}
            for(var i in list){
                if(list[i].province == ""){
                    no_prov.num = list[i].num;
                    arr.push(no_prov);
                }else{
                    var result = get_name_bypinyin(list[i].province);

                    if(result.province == list[i].province){
                        foreign.num += list[i].num;
                    }else{
                        list[i].province = result.province;
                        arr.push(list[i]);
                    }
                }
            }
            arr.push(foreign);

            $.each(arr, function (i, v) {
                xAxis.push(v.province);
                series.push(v.num)
            })

            analyse_area_option.xAxis[0].data = xAxis;
            analyse_area_option.series[0].data = series;
            user_area_chart.hideLoading();
            user_area_chart.setOption(analyse_area_option)
        })
    }

    // 页面初始化设置
    var init = function () {

        // 统计数字
        MD.ajax_get({url: 'admin/user/pieces'}, function (res) {
            $(".add-num").text(res.increase);
            $(".all-num").text(res.total);
        })


        $("#range").jeDate({
            isValue: true,
            format: "YYYY-MM-DD",
            range:" 至 "
        });

        /**
         * 统计图初始化
         */
        show_user_add();
        show_user_sex();
        show_user_area();
    }

    var bind_event = function () {
        $(".user-add-btn").on("click", function () {
            var val = $("#range").val()
            if(val != ""){
                var date = {
                    from: val.split(" ")[0],
                    to: val.split(" ")[2]
                }
                date = {
                    from: MD.date_format(date.from),
                    to: 86400 + MD.date_format(date.to)
                }
                // console.log(date)
                show_user_add(date);
            }
        })
    }

    init();
    bind_event();
})