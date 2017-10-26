
$(function () {
    var article_option = {
        title: {
            text: '文章阅读量走势图'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:['全站文章增长走势']
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
            data: []
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name:'全站文章增长走势',
                type:'line',
                stack: '',
                data: []
            }
        ]
    };
    var user_option = {
        title : {
            text: '各分类文章占比饼形图',
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'right',
            data: ['最美民宿','魔都景点','创业必读','美食舆情','鸡汤美文']
        },
        series : [
            {
                name: '数据类别',
                type: 'pie',
                radius : '85%',
                center: ['50%', '50%'],
                data:[
                    {value:335, name:'最美民宿'},
                    {value:310, name:'魔都景点'},
                    {value:234, name:'创业必读'},
                    {value:135, name:'美食舆情'},
                    {value:1548, name:'鸡汤美文'}
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };

    var art_line_chart = echarts.init(document.getElementById("article-line"));
    var user_pie_chart = echarts.init(document.getElementById("user-pie"));
    user_pie_chart.setOption(user_option);


    var show_line_chart = function (data) {
        var now = Math.round(new Date() / 1000);
        var before_tenDays = MD.date_format(MD.time_format(now - 864000).split(" ")[0]); // 十天前的0点
        data = MD.merger({'from': before_tenDays, 'to': now},data)
        console.log(data) // 此处时间戳长度为10，转换后为0:0:0
        art_line_chart.showLoading();

        MD.ajax_get({
            url: "admin/index/totalviews",
            data: data
        },function (res) {
            var list = res;
            var x = [], y = []

            for(var i=0; i<list.length; i++){
                x.push(list[i].date);
                if(i == 0){
                    y.push(list[i].views)
                }else{
                    y.push(list[i].views - list[i-1].views)
                }
            }

            article_option.xAxis.data = x;
            article_option.series[0].data = y;
            // console.log(article_option)
            art_line_chart.setOption(article_option);
            art_line_chart.hideLoading();
        })
    }

    var show_pie_chart = function (data) {
        user_pie_chart.showLoading();

        /*MD.ajax_get({
            url: ""
        },function (res) {
            user_pie_chart.hideLoading();
            // user_option.legend.data =
            // user_option.series[0].data =

        })*/
    }



    var bind_event = function () {
        $(".art-line-btn").on("click", function () {
            var data = {
                from: $(".time").val(),
                to: $(".time-to").val()
            }
            if(data.from != "" && data.to != ""){
                if(data.to < data.from){
                    jeBox.msg("起止时间有误",{icon: 1, time: 1.5});
                    return;
                }
                data.from = MD.date_format(data.from);
                data.to = 86400 + MD.date_format(data.to);
                show_line_chart(data);
            }
        })

    }

    var get_all_nums = function () {
        MD.ajax_get({url: "admin/index/nums"}, function (res) {
            $(".articlenums").text(res.articlenums);
            $(".topicnums").text(res.topicnums);
            $(".activitynums").text(res.activitynums);
            $(".usernums").text(res.usernums)
        })
    }
    /**
     * 页面初始化
     */
    var init = function () {
        jeDate({
            dateCell:".time",
            format:"YYYY-MM-DD",
            minDate:"2017-01-01",
            maxDate:"2099-01-01"
        })
        jeDate({
            dateCell:".time-to",
            format:"YYYY-MM-DD",
            minDate:"2017-01-01",
            maxDate:"2099-01-01"
        })

        get_all_nums();
        /**
         * 图表初始化，默认参数为空
         */
        show_pie_chart()
        show_line_chart();
    }


    init();
    bind_event();
})
