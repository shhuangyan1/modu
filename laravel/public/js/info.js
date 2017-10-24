
$(function () {
    var article_option = {
        title: {
            text: '文章增长走势图'
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
            data: ['10-01','10-02','10-03','10-04','10-05','10-06','10-07','10-08','10-09','10-10','10-01','10-02','10-03','10-04','10-05','10-06','10-07','10-08','10-09','10-10']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name:'全站文章增长走势',
                type:'line',
                stack: '',
                data:[420, 885, 923, 934, 1290, 1330, 1400, 1405, 1420, 1448,420, 885, 923, 934, 1290, 1330, 1400, 1405, 1420, 1448]
            }
        ]
    };

    var art_line_chart = echarts.init(document.getElementById("article-line"))
    art_line_chart.setOption(article_option);

    var show_line_chart = function (data) {
        var now = Math.round(new Date() / 1000);
        var before_tenDays = now - 864000;  // 时间为自当前时间起的十天前，非十天前的00:00:00，待调整
        data = MD.merger({'from': before_tenDays, 'to': now},data)
        console.log(data)
        art_line_chart.showLoading();

        // MD.ajax_get({
        //     url: "admin/sdfdf",
        //     data: data
        // },function (res) {
        //     // article_option.xAxis.data =
        //     // article_option.series.data =
        //     // art_line_chart.setOption(article_option);
        //
        // })
    }



    var bind_event = function () {
        $(".art-line-btn").on("click", function () {
            var data = {
                from: $(".time").val(),
                to: $(".time-to").val()
            }
            if(data.from != "" && data.to != ""){
                data.from = MD.date_format(data.from);
                data.to = 86400 + MD.date_format(data.to);
                show_line_chart(data);
            }
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

        /**
         * 图表初始化，默认参数为空
         */
        show_line_chart();
    }


    init();
    bind_event();
})
